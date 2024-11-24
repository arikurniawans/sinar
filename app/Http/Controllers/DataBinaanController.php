<?php

namespace App\Http\Controllers;

use App\Models\DataBinaan;
use App\Models\MasterKasus;
use Illuminate\Http\Request;
use App\Models\MasterWisma;
use Illuminate\Support\Facades\DB;

class DataBinaanController extends Controller
{
    //
    public function index()
    {
        // Ambil data pegawai dengan status = 2 dan urutkan secara descending berdasarkan kolom 'id'
        $data = [
            'title' => 'Manajemen Data Binaan Yayasan',
            'subtitle' => 'Tabel Data Binaan Yayasan',
            'databinaan' => DB::table('data_binaans')
                ->join('master_kasuses', 'data_binaans.ragam_disabilitas', '=', 'master_kasuses.idkasus')
                ->join('master_wismas', 'data_binaans.wisma', '=', 'master_wismas.idwisma') // Join tambahan
                ->select('data_binaans.idbinaan','data_binaans.nama', 'data_binaans.jenis_kelamin', 'master_kasuses.namakasus', 'master_wismas.nama_wisma') // Menambahkan kolom dari master_wisma
                ->orderBy('data_binaans.idbinaan', 'desc')
                ->get(),
            'breadcrumb' => [
                ['url' => 'databinaan.index' , 'name' => 'Manajemen Data Binaan Yayasan'],
            ],
        ];

        return view('databinaan.index', $data);
        // dd($data['databinaan']);
    }

    public function add()
    {
        $data = [
            'title' => 'Manajemen Data Binaan Yayasan',
            'subtitle' => 'Input Data Binaan Yayasan',
            'wisma' => MasterWisma::orderBy('idwisma', 'desc')->get(),
            'kasus' => MasterKasus::orderBy('idkasus', 'desc')->get(),
            'provinces' => json_decode(file_get_contents('https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json')),
            'breadcrumb' => [
                ['url' => 'databinaan.index' , 'name' => 'Manajemn Data Binaan Yayasan'],
            ],
        ];

        return view('databinaan.add', $data);
        // dd($data['provinces']);
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20',
            'no_kk' => 'required|string|max:20',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'alamat_ktp' => 'required|string|max:255',
            'rt' => 'required|string|max:5',
            'rw' => 'required|string|max:5',
            'dusun' => 'required|string|max:255',
            'nama_kel' => 'required',
            'idkel' => 'required',
            'nama_kec' => 'required',
            'idkec' => 'required',
            'nama_kabkot' => 'required',
            'idkabkot' => 'required',
            'nama_prop' => 'required',
            'idprov' => 'required',
            'ragam_disabilitas' => 'required|exists:master_kasuses,idkasus',
            'wisma' => 'required|exists:master_wismas,idwisma',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'keterangan' => 'nullable|string|max:255',
        ]);

        // Cek apakah NIK atau No KK sudah ada di database
        if (DataBinaan::where('nik', $validatedData['nik'])->exists()) {
            return redirect()->route('databinaan.add')->with('error', 'NIK sudah terdaftar !');
        }

        if (DataBinaan::where('no_kk', $validatedData['no_kk'])->exists()) {
            return redirect()->route('databinaan.add')->with('error', 'No KK sudah terdaftar !');
        }

        // Mengupload foto ke folder public/databina
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $file = $request->file('foto');
            $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/jpg'];

            if (in_array($file->getMimeType(), $allowedMimeTypes)) {
                $fotoPath = 'databina/' . $file->getClientOriginalName(); // Mengubah path ke folder databina
                $file->move(public_path('databina'), $file->getClientOriginalName()); // Memindahkan file ke folder databina
                $validatedData['foto'] = $fotoPath; // Menyimpan path foto
            } else {
                // Menangani kasus di mana file bukan tipe gambar yang diizinkan
                return redirect()->route('databinaan.add')->with('error', 'Hanya file gambar yang diizinkan.');
            }
        }

        // Simpan data ke dalam model DataBinaan
        DataBinaan::create($validatedData); // Menggunakan mass assignment untuk menyimpan data
        // dd($validatedData);
        // Redirect ke halaman yang diinginkan setelah penyimpanan
        return redirect()->route('databinaan.index')->with('success', 'Data berhasil disimpan.');
    }

    public function kabkota($idprovinsi)
    {
        $url = "https://emsifa.github.io/api-wilayah-indonesia/api/regencies/{$idprovinsi}.json";
        $response = @file_get_contents($url); // Menambahkan @ untuk menangani kesalahan
        if ($response === false) {
            abort(500); // Mengarahkan ke halaman 500 jika tidak ada koneksi
        }
        return response()->json(json_decode($response));
    }

    public function kecamatan($idKota)
    {
        $url = "https://emsifa.github.io/api-wilayah-indonesia/api/districts/{$idKota}.json";
        $response = @file_get_contents($url); // Menambahkan @ untuk menangani kesalahan
        if ($response === false) {
            abort(500); // Mengarahkan ke halaman 500 jika tidak ada koneksi
        }
        return response()->json(json_decode($response));
    }

    public function kelurahan($idKecamatan)
    {
        $url = "https://emsifa.github.io/api-wilayah-indonesia/api/villages/{$idKecamatan}.json";
        $response = @file_get_contents($url); // Menambahkan @ untuk menangani kesalahan
        if ($response === false) {
            abort(500); // Mengarahkan ke halaman 500 jika tidak ada koneksi
        }
        return response()->json(json_decode($response));
    }

    public function edit($id)
    {
        // Mengambil data berdasarkan ID
        $data = [
            'title' => 'Manajemen Data Binaan Yayasan',
            'subtitle' => 'Edit Data Binaan Yayasan',
            'provinces' => json_decode(file_get_contents('https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json')),
            'databinaan' => DB::table('data_binaans')
                ->join('master_kasuses', 'data_binaans.ragam_disabilitas', '=', 'master_kasuses.idkasus')
                ->join('master_wismas', 'data_binaans.wisma', '=', 'master_wismas.idwisma') // Join tambahan
                ->select('data_binaans.*', 'master_kasuses.*', 'master_wismas.*') // Menambahkan kolom dari master_wisma
                ->where('data_binaans.idbinaan', $id)
                ->first(),
            'wisma' => MasterWisma::orderBy('idwisma', 'desc')->get(),
            'kasus' => MasterKasus::orderBy('idkasus', 'desc')->get(),
            'breadcrumb' => [
                ['url' => 'databinaan.index' , 'name' => 'Manajemen Data Binaan Yayasan'],
            ],
        ];

        return view('databinaan.edit', $data);
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20',
            'no_kk' => 'required|string|max:20',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'alamat_ktp' => 'required|string|max:255',
            'rt' => 'required|string|max:5',
            'rw' => 'required|string|max:5',
            'dusun' => 'required|string|max:255',
            'nama_kel' => 'required',
            'idkel' => 'required',
            'nama_kec' => 'required',
            'idkec' => 'required',
            'nama_kabkot' => 'required',
            'idkabkot' => 'required',
            'nama_prop' => 'required',
            'idprov' => 'required',
            'ragam_disabilitas' => 'required|exists:master_kasuses,idkasus',
            'wisma' => 'required|exists:master_wismas,idwisma',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'keterangan' => 'nullable|string|max:255',
        ]);

        // Mengambil data yang akan diperbarui
        $databinaan = DataBinaan::findOrFail($id);

        // Cek apakah NIK atau No KK sudah ada di database (kecuali untuk data yang sama)
        if (DataBinaan::where('nik', $validatedData['nik'])->where('idbinaan', '!=', $id)->exists()) {
            return redirect()->route('databinaan.edit', $id)->with('error', 'NIK sudah terdaftar !');
        }

        if (DataBinaan::where('no_kk', $validatedData['no_kk'])->where('idbinaan', '!=', $id)->exists()) {
            return redirect()->route('databinaan.edit', $id)->with('error', 'No KK sudah terdaftar !');
        }

        // Menghapus foto lama jika ada dan jika ada foto baru yang diupload
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            if ($databinaan->foto && file_exists(public_path($databinaan->foto))) {
                unlink(public_path($databinaan->foto)); // Menghapus file foto lama
            }

            // Mengupload foto jika ada
            $file = $request->file('foto');
            $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/jpg'];

            if (in_array($file->getMimeType(), $allowedMimeTypes)) {
                $fotoPath = 'databina/' . $file->getClientOriginalName();
                $file->move(public_path('databina'), $file->getClientOriginalName());
                $validatedData['foto'] = $fotoPath;
            } else {
                return redirect()->route('databinaan.edit', $id)->with('error', 'Hanya file gambar yang diizinkan.');
            }
        } else {
            // Jika tidak ada foto baru, tetap gunakan foto yang lama
            // Tidak perlu menghapus foto lama jika tidak ada upload foto
            if (!$request->hasFile('foto')) { // Cek jika tidak ada file foto yang diupload
                $validatedData['foto'] = $databinaan->foto; // Tetap gunakan foto yang lama
            }
        }

        // Memperbarui data ke dalam model DataBinaan
        $databinaan->update($validatedData);

        // Redirect ke halaman yang diinginkan setelah pembaruan
        return redirect()->route('databinaan.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function show($id)
    {
        // Mengambil data berdasarkan ID
        // $databinaan = DataBinaan::findOrFail($id);
        // Menyiapkan data untuk ditampilkan
        $data = [
            'title' => 'Manajemen Data Binaan Yayasan',
            'subtitle' => 'Detail Data Binaan Yayasan',
            'data_binaan' => DB::table('data_binaans')
                ->join('master_kasuses', 'data_binaans.ragam_disabilitas', '=', 'master_kasuses.idkasus')
                ->join('master_wismas', 'data_binaans.wisma', '=', 'master_wismas.idwisma') // Join tambahan
                ->select('data_binaans.*', 'master_kasuses.*', 'master_wismas.*') // Menambahkan kolom dari master_wisma
                ->where('data_binaans.idbinaan', $id)
                ->first(),
            'breadcrumb' => [
                ['url' => 'databinaan.index' , 'name' => 'Manajemen Data Binaan Yayasan'],
            ],
        ];

        return view('databinaan.show', $data);
    }

    public function destroy($id)
    {
        try {
            // Mengambil data berdasarkan ID
            $databinaan = DataBinaan::findOrFail($id);

            // Menghapus foto jika ada
            if ($databinaan->foto && file_exists(public_path($databinaan->foto))) {
                unlink(public_path($databinaan->foto)); // Menghapus file foto
            }

            // Menghapus data dari database
            $databinaan->delete();

            // Mengembalikan respons JSON jika berhasil
            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus.']);
        } catch (\Exception $e) {
            // Mengembalikan respons JSON jika terjadi kesalahan
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

}
