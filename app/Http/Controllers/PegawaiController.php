<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\MasterNomor;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    //
    public function index()
    {
        // Ambil data pegawai dan urutkan secara descending berdasarkan kolom 'created_at'

        $data = [
            'title' => 'Manajemen Data Pegawai Tetap',
            'subtitle' => 'Tabel Data Pegawai Tetap',
            'data' => Employee::where('status', 1)
                ->join('master_nomors', 'employees.nomor_induk', '=', 'master_nomors.idnomor')
                ->select('employees.*')
                ->orderBy('employees.id', 'desc')
                ->get(),
            'breadcrumb' => [
                ['url' => 'pegawai.index' , 'name' => 'Data Pegawai Tetap'],
            ],
        ];

        return view('pegawai.index', $data);
        // dd($data);
    }

    public function add()
    {

        $data = [
            'title' => 'Manajemen Data Pegawai Tetap',
            'subtitle' => 'Input Data Pegawai Tetap',
            'nomor' => MasterNomor::orderBy('idnomor', 'desc')->get(),
            'breadcrumb' => [
                ['url' => 'pegawai.index' , 'name' => 'Data Pegawai Tetap'],
            ],
        ];

        return view('pegawai.add', $data);

    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nomor_induk' => 'nullable|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'agama' => 'nullable|string|max:255',
            'jenis_kelamin' => 'nullable|string|max:255',
            'ijazah_tahun' => 'nullable|string|max:255',
            'tahun_mulai_bekerja' => 'nullable|date',
            'jabatan_tugas' => 'nullable|string|max:255',
            'no_kk' => 'nullable|string|max:255',
            'nik' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // For image upload
            'unit' => 'nullable|string|max:255',
            'status' => '1', // Ensure status is either 1 or 2
        ]);

        try {
            // Cek jika pegawai dengan 'nomor_induk', 'no_kk', atau 'nik' yang sama sudah ada
            if (Employee::where('no_kk', $validatedData['no_kk'])
                ->orWhere('nik', $validatedData['nik'])
                ->exists()) {
                return redirect()->back()->withErrors('Pegawai dengan no KK atau NIK ini sudah ada.')->withInput();
            }

            // Handle file upload for 'foto' if provided
            if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                $file = $request->file('foto');
                $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/jpg'];

                if (in_array($file->getMimeType(), $allowedMimeTypes)) {
                    $fotoPath = 'pegawai/tetap/' . $file->getClientOriginalName();
                    $file->move(public_path('pegawai/tetap'), $file->getClientOriginalName());
                    $validatedData['foto'] = $fotoPath;
                } else {
                    // Handle the case where the file is not an allowed image type
                    return redirect()->route('pegawai.add')->with('error', 'Only image files are allowed.');
                }
            }

            // Save validated data into Employee model
            Employee::create($validatedData);
            // Redirect or respond with success message
            return redirect()->route('pegawai.index')->with('success', 'Employee added successfully.');
        } catch (\Exception $e) {
            // Handle the error and redirect with an error message
            // dd($e->getMessage());
            return redirect()->route('pegawai.add')->with('error', 'Failed to add employee: ' . $e->getMessage());
        }
        // dd($validatedData);
    }

    public function show($id)
    {
        // Ambil data pegawai berdasarkan ID
        $pegawai = Employee::where('employees.id', $id)
            ->join('master_nomors', 'employees.nomor_induk', '=', 'master_nomors.idnomor')
            ->select('employees.*', 'master_nomors.*') // Menyertakan kolom dari master_nomors jika diperlukan
            ->first();

        // Jika data pegawai tidak ditemukan, kembalikan dengan pesan error
        if (!$pegawai) {
            return redirect()->route('pegawai.index')->with('error', 'Pegawai tidak ditemukan.');
        }

        $data = [
            'title' => 'Manajemen Data Pegawai Tetap',
            'subtitle' => 'Detail Data Pegawai Tetap',
            'pegawai' => $pegawai,
            'breadcrumb' => [
                ['url' => 'pegawai.index', 'name' => 'Data Pegawai Tetap'],
            ],
        ];

        return view('pegawai.show', $data);
        // dd($data['pegawai']);
    }

    public function edit($id)
    {
        // Ambil data pegawai berdasarkan ID
        $pegawai = Employee::where('employees.id', $id)
            ->join('master_nomors', 'employees.nomor_induk', '=', 'master_nomors.idnomor')
            ->select('employees.*', 'master_nomors.*') // Menyertakan kolom dari master_nomors jika diperlukan
            ->first();

        // Jika data pegawai tidak ditemukan, kembalikan dengan pesan error
        if (!$pegawai) {
            return redirect()->route('pegawai.index')->with('error', 'Pegawai tidak ditemukan.');
        }

        $data = [
            'title' => 'Manajemen Data Pegawai Tetap',
            'subtitle' => 'Edit Data Pegawai Tetap',
            'pegawai' => $pegawai,
            'nomor' => MasterNomor::orderBy('idnomor', 'desc')->get(),
            'breadcrumb' => [
                ['url' => 'pegawai.index', 'name' => 'Data Pegawai Tetap'],
            ],
        ];

        return view('pegawai.edit', $data);
        // dd($data['pegawai']);
    }

    public function update(Request $request, $id)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nomor_induk' => 'nullable|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'agama' => 'nullable|string|max:255',
            'jenis_kelamin' => 'nullable|string|max:255',
            'ijazah_tahun' => 'nullable|string|max:255',
            'tahun_mulai_bekerja' => 'nullable|date',
            'jabatan_tugas' => 'nullable|string|max:255',
            'no_kk' => 'nullable|string|max:255',
            'nik' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // For image upload
            'unit' => 'nullable|string|max:255',
            'status' => '1', // Ensure status is either 1 or 2
        ]);

        try {
            // Ambil data pegawai berdasarkan ID
            $pegawai = Employee::find($id);
            if (!$pegawai) {
                return redirect()->route('pegawai.index')->with('error', 'Pegawai tidak ditemukan.');
            }

            // Handle file upload for 'foto' if provided
            if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                $file = $request->file('foto');
                $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/jpg'];

                if (in_array($file->getMimeType(), $allowedMimeTypes)) {
                    // Hapus foto lama jika ada sebelum menyimpan foto baru
                    if (isset($pegawai) && $pegawai->foto) {
                        $oldFotoPath = public_path($pegawai->foto);
                        if (file_exists($oldFotoPath)) {
                            unlink($oldFotoPath); // Menghapus file foto lama
                        }
                    }
                    $fotoPath = 'pegawai/tetap/' . $file->getClientOriginalName();
                    $file->move(public_path('pegawai/tetap'), $file->getClientOriginalName());
                    $validatedData['foto'] = $fotoPath;
                } else {
                    return redirect()->route('pegawai.edit', $id)->with('error', 'Hanya file gambar yang diizinkan.');
                }
            } else {
                // Jika tidak ada foto yang diupload, tetap gunakan data yang sudah ada
                $validatedData['foto'] = $pegawai->foto; // Menggunakan foto yang sudah ada
            }

            // Update data pegawai
            $pegawai->update($validatedData);
            return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('pegawai.edit', $id)->with('error', 'Gagal memperbarui data pegawai: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            // Ambil data pegawai berdasarkan ID
            $pegawai = Employee::find($id);
            if (!$pegawai) {
                return response()->json(['error' => 'Pegawai tidak ditemukan.'], 404);
            }

            // Hapus foto jika ada
            if ($pegawai->foto) {
                $oldFotoPath = public_path($pegawai->foto);
                if (file_exists($oldFotoPath)) {
                    unlink($oldFotoPath); // Menghapus file foto
                }
            }

            // Hapus data pegawai
            $pegawai->delete();
            return response()->json(['success' => 'Data pegawai berhasil dihapus.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menghapus data pegawai: ' . $e->getMessage()], 500);
        }
    }

}
