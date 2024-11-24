<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\MasterNomor;
use Illuminate\Support\Facades\Validator;

class Pegawai2Controller extends Controller
{
    //
    public function index()
    {
        // Ambil data pegawai dengan status = 2 dan urutkan secara descending berdasarkan kolom 'id'
        $data = [
            'title' => 'Manajemen Data Pegawai Tidak Tetap',
            'subtitle' => 'Tabel Data Pegawai Tidak Tetap',
            'data' => Employee::where('status', 2)
                    ->join('master_nomors', 'employees.nomor_induk', '=', 'master_nomors.idnomor')
                    ->select('employees.*')
                    ->orderBy('employees.id', 'desc')
                    ->get(),
            'breadcrumb' => [
                ['url' => 'pegawai2.index' , 'name' => 'Data Pegawai Tidak Tetap'],
            ],
        ];

        return view('pegawai_2.index', $data);
        // dd($data['data']);
    }

    public function add()
    {
        $data = [
            'title' => 'Manajemen Data Pegawai Tidak Tetap',
            'subtitle' => 'Input Data Pegawai Tidak Tetap',
            'nomor' => MasterNomor::orderBy('idnomor', 'desc')->get(),
            'breadcrumb' => [
                ['url' => 'pegawai2.index' , 'name' => 'Data Pegawai Tidak Tetap'],
            ],
        ];

        return view('pegawai_2.add', $data);

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
            'keterangan' => 'nullable|string|max:255',
            'status' => '2', // Ensure status is either 1 or 2
        ]);

        try {
            // Cek jika pegawai dengan data yang sama sudah ada
            if (Employee::Where('nama_lengkap', $validatedData['nama_lengkap'])
                ->exists()) {
                return redirect()->back()->withErrors('Pegawai dengan data yang sama sudah ada.')->withInput();
            }

            // Save validated data into Employee model without handling file upload
            $validatedData['status'] = 2; // Menambahkan status = 2
            Employee::create($validatedData);
            // Redirect or respond with success message
            return redirect()->route('pegawai2.index')->with('success', 'Employee added successfully.');
        } catch (\Exception $e) {
            // Handle the error and redirect with an error message
            return redirect()->route('pegawai2.add')->with('error', 'Failed to add employee: ' . $e->getMessage());
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
            return redirect()->route('pegawai2.index')->with('error', 'Pegawai tidak ditemukan.');
        }

        $data = [
            'title' => 'Manajemen Data Pegawai Tidak Tetap',
            'subtitle' => 'Detail Data Pegawai Tidak Tetap',
            'pegawai' => $pegawai,
            'breadcrumb' => [
                ['url' => 'pegawai2.index', 'name' => 'Data Pegawai Tidak Tetap'],
            ],
        ];

        return view('pegawai_2.show', $data);
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
            return redirect()->route('pegawai2.index')->with('error', 'Pegawai tidak ditemukan.');
        }

        $data = [
            'title' => 'Manajemen Data Pegawai Tetap',
            'subtitle' => 'Edit Data Pegawai Tetap',
            'pegawai' => $pegawai,
            'nomor' => MasterNomor::orderBy('idnomor', 'desc')->get(),
            'breadcrumb' => [
                ['url' => 'pegawai2.index', 'name' => 'Data Pegawai Tidak Tetap'],
            ],
        ];

        return view('pegawai_2.edit', $data);
    }

    public function update(Request $request, $id)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nomor_induk' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:255',
            'ijazah_tahun' => 'required|string|max:255',
            'tahun_mulai_bekerja' => 'required|date',
            'jabatan_tugas' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
            'status' => '2', // Ensure status is either 1 or 2
        ]);

        try {
            // Ambil data pegawai berdasarkan ID
            $pegawai = Employee::find($id);
            if (!$pegawai) {
                return redirect()->route('pegawai2.index')->with('error', 'Pegawai tidak ditemukan.');
            }
            // Update data pegawai
            $pegawai->update($validatedData);
            return redirect()->route('pegawai2.index')->with('success', 'Data pegawai berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('pegawai2.edit', $id)->with('error', 'Gagal memperbarui data pegawai: ' . $e->getMessage());
        }
        // dd($validatedData);
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
            // if ($pegawai->foto) {
            //     $oldFotoPath = public_path($pegawai->foto);
            //     if (file_exists($oldFotoPath)) {
            //         unlink($oldFotoPath); // Menghapus file foto
            //     }
            // }

            // Hapus data pegawai
            $pegawai->delete();
            return response()->json(['success' => 'Data pegawai berhasil dihapus.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menghapus data pegawai: ' . $e->getMessage()], 500);
        }
    }

}
