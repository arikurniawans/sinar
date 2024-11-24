<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\MasterKasus;
use Illuminate\Http\Request;
use App\Models\MasterWisma;
use Illuminate\Support\Facades\DB;
use App\Exports\WismaExport;
use Maatwebsite\Excel\Facades\Excel;

class MasterWismaController extends Controller
{
    //
    public function index()
    {
        // Ambil data pegawai dengan status = 2 dan urutkan secara descending berdasarkan kolom 'id'
        $data = [
            'title' => 'Manajemen Data Wisma',
            'subtitle' => 'Tabel Manajemen Data Wisma',
            'data' => MasterWisma::orderBy('idwisma', 'desc')->get(),
            'breadcrumb' => [
                ['url' => 'masterwisma.index' , 'name' => 'Manajemen Data Wisma'],
            ],
        ];

        return view('masterwisma.index', $data);
        // dd($data['data']);
    }

    public function add()
    {
        $pembina = Employee::where('status', 2)->get();
        $supervisor = Employee::where('status', 1)->get();

        $data = [
            'title' => 'Manajemen Data Wisma',
            'subtitle' => 'Input Manajemen Data Wisma',
            'pembina' => $pembina,
            'supervisor' => $supervisor,
            'breadcrumb' => [
                ['url' => 'masterwisma.index' , 'name' => 'Manajemen Data Wisma'],
            ],
        ];

        return view('masterwisma.add', $data);
        // dd($data['supervisor']);

    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'nama_wisma' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'pembina_wisma' => 'required|string',
            'jumlah_kamar' => 'required|integer',
            'supervisor' => 'required|string',
            'jumlah_tmp_tidur' => 'required|integer',
            'jumlah_tng_purna' => 'required|integer',
            'jumlah_tng_part' => 'required|integer',
            'jumlah_anak' => 'required|integer',
            // Tambahkan validasi lain sesuai kebutuhan
        ], [
            'nama_wisma.required' => 'Nama harus diisi.',
            'nama_wisma.string' => 'Nama harus berupa teks.',
            'nama_wisma.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'alamat.required' => 'Lokasi harus diisi.',
            'alamat.string' => 'Lokasi harus berupa teks.',
            'alamat.max' => 'Lokasi tidak boleh lebih dari 255 karakter.',
            'pembina_wisma.required' => 'Pembina Wisma harus dipilih.',
            'supervisor.required' => 'Supervisor harus dipilih.',
            'jumlah_tng_purna.required' => 'Jumlah Tenaga Purna Waktu harus diisi.',
            'jumlah_tng_part.required' => 'Jumlah Tenaga Part Time harus diisi.',
            'jumlah_kamar.required' => 'Jumlah Kamar harus diisi.',
            'jumlah_tmp_tidur.required' => 'Jumlah Tempat Tidur harus diisi.',
            'jumlah_anak.required' => 'Jumlah Anak harus diisi.',
            'integer' => 'Harus berupa angka.',
        ]);

        // Cek jika nama wisma sudah ada
        if (MasterWisma::where('nama_wisma', $request->nama_wisma)->exists()) {
            return redirect()->back()->withErrors(['nama_wisma' => 'Nama wisma sudah ada.'])->withInput();
        }

        // Simpan data ke dalam database
        MasterWisma::create([
            'nama_wisma' => $request->nama_wisma,
            'alamat' => $request->alamat,
            'pembina_wisma' => $request->pembina_wisma,
            'supervisor' => $request->supervisor,
            'jumlah_kamar' => $request->jumlah_kamar,
            'jumlah_tmp_tidur' => $request->jumlah_tmp_tidur,
            'jumlah_tng_purna' => $request->jumlah_tng_purna,
            'jumlah_tng_part' => $request->jumlah_tng_part,
            'jumlah_anak' => $request->jumlah_anak,
        ]);

        return redirect()->route('masterwisma.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // Ambil data wisma berdasarkan ID
        $wisma = MasterWisma::findOrFail($id);
        $pembina = Employee::where('status', 2)->get();
        $supervisor = Employee::where('status', 1)->get();

        $data = [
            'title' => 'Manajemen Data Wisma',
            'subtitle' => 'Edit Manajemen Data Wisma',
            'pembina' => $pembina,
            'supervisor' => $supervisor,
            'wisma' => $wisma,
            'breadcrumb' => [
                ['url' => 'masterwisma.index' , 'name' => 'Manajemen Data Wisma'],
            ],
        ];

        return view('masterwisma.edit', $data);
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'nama_wisma' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'pembina_wisma' => 'required|string',
            'jumlah_kamar' => 'required|integer',
            'supervisor' => 'required|string',
            'jumlah_tmp_tidur' => 'required|integer',
            'jumlah_tng_purna' => 'required|integer',
            'jumlah_tng_part' => 'required|integer',
            'jumlah_anak' => 'required|integer',
            // Tambahkan validasi lain sesuai kebutuhan
        ], [
            'nama_wisma.required' => 'Nama harus diisi.',
            'nama_wisma.string' => 'Nama harus berupa teks.',
            'nama_wisma.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'alamat.required' => 'Lokasi harus diisi.',
            'alamat.string' => 'Lokasi harus berupa teks.',
            'alamat.max' => 'Lokasi tidak boleh lebih dari 255 karakter.',
            'pembina_wisma.required' => 'Pembina Wisma harus dipilih.',
            'supervisor.required' => 'Supervisor harus dipilih.',
            'jumlah_tng_purna.required' => 'Jumlah Tenaga Purna Waktu harus diisi.',
            'jumlah_tng_part.required' => 'Jumlah Tenaga Part Time harus diisi.',
            'jumlah_kamar.required' => 'Jumlah Kamar harus diisi.',
            'jumlah_tmp_tidur.required' => 'Jumlah Tempat Tidur harus diisi.',
            'jumlah_anak.required' => 'Jumlah Anak harus diisi.',
            'integer' => 'Harus berupa angka.',
        ]);

        // Ambil data wisma berdasarkan ID
        $wisma = MasterWisma::findOrFail($id);

        // Cek jika nama wisma sudah ada dan bukan milik wisma yang sedang diedit
        if (MasterWisma::where('nama_wisma', $request->nama_wisma)->where('idwisma', '!=', $id)->exists()) {
            return redirect()->back()->withErrors(['nama_wisma' => 'Nama wisma sudah ada.'])->withInput();
        }

        // Perbarui data wisma
        $wisma->update([
            'nama_wisma' => $request->nama_wisma,
            'alamat' => $request->alamat,
            'pembina_wisma' => $request->pembina_wisma,
            'supervisor' => $request->supervisor,
            'jumlah_kamar' => $request->jumlah_kamar,
            'jumlah_tmp_tidur' => $request->jumlah_tmp_tidur,
            'jumlah_tng_purna' => $request->jumlah_tng_purna,
            'jumlah_tng_part' => $request->jumlah_tng_part,
            'jumlah_anak' => $request->jumlah_anak,
            // Tambahkan field lain sesuai kebutuhan
        ]);

        return redirect()->route('masterwisma.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Ambil data wisma berdasarkan ID
        $wisma = MasterWisma::findOrFail($id);

        // Hapus data wisma
        $wisma->delete();

        // Mengubah response menjadi JSON
        return response()->json(['message' => 'Data berhasil dihapus.']);
    }

    public function addpengurus($id)
    {
        // Ambil data wisma berdasarkan ID
        $wisma = MasterWisma::findOrFail($id);
        $pengurus = Employee::get();
        $kasus = MasterKasus::get();
        $tenaga = DB::table('det_masterwisma')
            ->join('employees', 'det_masterwisma.idemployee', '=', 'employees.id')
            ->select('employees.no_kk', 'employees.nik', 'employees.nama_lengkap', 'employees.ijazah_tahun', 'employees.jabatan_tugas', 'employees.tempat_lahir', 'employees.tanggal_lahir', 'employees.keterangan', 'det_masterwisma.idwisma', 'det_masterwisma.id_masterwisma')
            ->where('det_masterwisma.idwisma', $id)
            ->orderBy('det_masterwisma.id_masterwisma', 'desc')
            ->get();

        $clients = DB::table('data_klien_wisma')
        ->join('master_kasuses', 'data_klien_wisma.kode_kasus', '=', 'master_kasuses.idkasus')
        ->select(
            'data_klien_wisma.*',
            'master_kasuses.idkasus',
            'master_kasuses.kode',
            'master_kasuses.namakasus'
        )
        ->where('data_klien_wisma.idwisma', $id)
        ->orderBy('data_klien_wisma.id_klienwisma', 'desc')
            ->get();

        $data = [
            'title' => 'Manajemen Data Wisma',
            'subtitle1' => 'Detail Data Wisma',
            'subtitle2' => 'Input Pengurus Wisma',
            'subtitle3' => 'Input Penghuni Wisma',
            'pengurus' => $pengurus,
            'kasus' => $kasus,
            'tenaga' => $tenaga,
            'wisma' => $wisma,
            'dataklien' => $clients,
            'breadcrumb' => [
                ['url' => 'masterwisma.index' , 'name' => 'Manajemen Data Wisma'],
            ],
        ];

        return view('masterwisma.add2', $data);
    }

    public function getpengurus($id)
    {
        $data = Employee::select('no_kk', 'nik', 'nama_lengkap','ijazah_tahun','tempat_lahir','tanggal_lahir','jabatan_tugas','keterangan')
                        ->where('id', $id)
                        ->first();

        if ($data) {
            return response()->json([
                'status' => 'success',
                'data' => $data,
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Data tidak ditemukan.',
        ]);
    }

    public function store2(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'idwisma' => 'required|integer|exists:master_wismas,idwisma',
            'nama_lengkap' => 'required|integer|exists:employees,id',
        ], [
            'idwisma.required' => 'ID Wisma harus diisi.',
            'nama_lengkap.required' => 'ID Employee harus diisi.',
            'exists' => 'Data tidak ditemukan.',
        ]);

        // Cek jika idemployee sudah ada dalam det_masterwisma
        // Ambil ID Employee dari input
        $idEmployee = $request->nama_lengkap;

        // Cek jika idemployee sudah ada dalam det_masterwisma untuk idwisma tertentu
        $isExists = DB::table('det_masterwisma')
            ->where('idemployee', $idEmployee)
            // ->where('idwisma', $request->idwisma)
            ->exists();

        if ($isExists) {
            return redirect()->back()
                ->withErrors(['nama_lengkap' => 'ID Employee sudah ada dalam wisma ini.'])
                ->withInput();
        }

        // Simpan data ke dalam tabel det_masterwisma
        DB::table('det_masterwisma')->insert([
            'idwisma' => $request->idwisma,
            'idemployee' => $request->nama_lengkap,
        ]);

        return redirect()->route('masterwisma.addpengurus', ['id' => $request->idwisma])->with('success', 'Data berhasil ditambahkan.');
    }


    public function destroy2($id_masterwisma)
    {
        // Hapus data dari det_masterwisma berdasarkan id_masterwisma
        DB::table('det_masterwisma')->where('id_masterwisma', $id_masterwisma)->delete();

        // Mengubah response menjadi JSON
        return response()->json(['message' => 'Data berhasil dihapus dari']);
    }

    public function store3(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'idwisma2' => 'required|integer',
            'no_induk' => 'required|string|max:20',
            'tahun_masuk' => 'required|integer|min:1900|max:2100',
            'no_kk' => 'required|string|max:50',
            'no_nik' => 'required|string|max:50',
            'nama_klien' => 'required|string|max:250',
            'tgl_lahir' => 'required|date',
            'umur' => 'required|integer|min:0',
            'sekolah' => 'required|string|max:250',
            'kelas' => 'required|string|max:250',
            'tingkat_per' => 'required|string|max:50',
            'kode_keuangan' => 'required|string|max:50',
            'tanggal_pemeriksaan_1' => 'required|date',
            'bb_1' => 'required|integer|min:0',
            'tb_1' => 'required|integer|min:0',
            'tanggal_pemeriksaan_2' => 'required|date',
            'bb_2' => 'required|integer|min:0',
            'tb_2' => 'required|integer|min:0',
            'kode_kasus' => 'required|integer',
            'keterangan' => 'required|string|max:250',
        ]);

        // Cek jika no_kk, no_nik, atau no_induk sudah ada
            $exists = DB::table('data_klien_wisma')
            ->where('no_kk', $validatedData['no_kk'])
            ->orWhere('no_nik', $validatedData['no_nik'])
            ->orWhere('no_induk', $validatedData['no_induk'])
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->withErrors(['duplicate' => 'No KK, No NIK, atau No Induk sudah ada.'])
                ->withInput();
        }

        // Simpan data ke dalam database
        DB::table('data_klien_wisma')->insert([
            'idwisma' => $validatedData['idwisma2'],
            'no_induk' => $validatedData['no_induk'],
            'tahun_masuk' => $validatedData['tahun_masuk'],
            'no_kk' => $validatedData['no_kk'],
            'no_nik' => $validatedData['no_nik'],
            'nama_klien' => $validatedData['nama_klien'],
            'tgl_lahir' => $validatedData['tgl_lahir'],
            'umur' => $validatedData['umur'],
            'sekolah' => $validatedData['sekolah'],
            'kelas' => $validatedData['kelas'],
            'tingkat_per' => $validatedData['tingkat_per'],
            'kode_keuangan' => $validatedData['kode_keuangan'],
            'tanggal_pemeriksaan_1' => $validatedData['tanggal_pemeriksaan_1'],
            'bb_1' => $validatedData['bb_1'],
            'tb_1' => $validatedData['tb_1'],
            'tanggal_pemeriksaan_2' => $validatedData['tanggal_pemeriksaan_2'],
            'bb_2' => $validatedData['bb_2'],
            'tb_2' => $validatedData['tb_2'],
            'kode_kasus' => $validatedData['kode_kasus'],
            'keterangan' => $validatedData['keterangan'],
        ]);
        // Redirect dengan pesan sukses
        return redirect()->route('masterwisma.addpengurus', ['id' => $request->idwisma2])->with('success', 'Data berhasil ditambahkan.');
        // dd($validatedData);
    }


    public function update3(Request $request, $id)
    {
        // Validasi input dari form
        $validatedData = $request->validate([
            'idwisma2' => 'required|integer',
            'no_induk' => 'required|string|max:20',
            'tahun_masuk' => 'required|integer|min:1900|max:2100',
            'no_kk' => 'required|string|max:50',
            'no_nik' => 'required|string|max:50',
            'nama_klien' => 'required|string|max:250',
            'tgl_lahir' => 'required|date',
            'umur' => 'required|integer|min:0',
            'sekolah' => 'required|string|max:250',
            'kelas' => 'required|string|max:250',
            'tingkat_per' => 'required|string|max:50',
            'kode_keuangan' => 'required|string|max:50',
            'tanggal_pemeriksaan_1' => 'required|date',
            'bb_1' => 'required|integer|min:0',
            'tb_1' => 'required|integer|min:0',
            'tanggal_pemeriksaan_2' => 'required|date',
            'bb_2' => 'required|integer|min:0',
            'tb_2' => 'required|integer|min:0',
            'kode_kasus' => 'required|integer',
            'keterangan' => 'required|string|max:250',
        ]);

        // Update data menggunakan Query Builder
        $data = DB::table('data_klien_wisma')->where('id_klienwisma', $id)->first();

        if (!$data) {
            return redirect()->back()->withErrors(['error' => 'Data tidak ditemukan.']);
        }

        // Update data menggunakan Query Builder
        DB::table('data_klien_wisma')
            ->where('id_klienwisma', $id) // Perbaikan: Hapus spasi ekstra
            ->update([
                'idwisma' => $validatedData['idwisma2'],
                'no_induk' => $validatedData['no_induk'],
                'tahun_masuk' => $validatedData['tahun_masuk'],
                'no_kk' => $validatedData['no_kk'],
                'no_nik' => $validatedData['no_nik'],
                'nama_klien' => $validatedData['nama_klien'],
                'tgl_lahir' => $validatedData['tgl_lahir'],
                'umur' => $validatedData['umur'],
                'sekolah' => $validatedData['sekolah'],
                'kelas' => $validatedData['kelas'],
                'tingkat_per' => $validatedData['tingkat_per'],
                'kode_keuangan' => $validatedData['kode_keuangan'],
                'tanggal_pemeriksaan_1' => $validatedData['tanggal_pemeriksaan_1'],
                'bb_1' => $validatedData['bb_1'],
                'tb_1' => $validatedData['tb_1'],
                'tanggal_pemeriksaan_2' => $validatedData['tanggal_pemeriksaan_2'],
                'bb_2' => $validatedData['bb_2'],
                'tb_2' => $validatedData['tb_2'],
                'kode_kasus' => $validatedData['kode_kasus'],
                'keterangan' => $validatedData['keterangan'],
            ]);

        // Redirect ke route dengan parameter dan pesan sukses
        return redirect()->route('masterwisma.addpengurus', ['id' => $request->idwisma2])
                        ->with('success', 'Data berhasil diubah.');
        }

        public function destroy3($id_klienwisma)
        {
            // Hapus data dari data_klien_wisma berdasarkan id_klienwisma
            DB::table('data_klien_wisma')->where('id_klienwisma', $id_klienwisma)->delete();

            // Mengubah response menjadi JSON
            return response()->json(['message' => 'Data berhasil dihapus']);
        }

        public function exportexcel($id)
        {
            $tenaga = DB::table('det_masterwisma')
                ->join('master_wismas', 'det_masterwisma.idwisma', '=', 'master_wismas.idwisma')
                ->join('employees', 'det_masterwisma.idemployee', '=', 'employees.id')
                ->select('master_wismas.*','employees.no_kk', 'employees.nik', 'employees.nama_lengkap', 'employees.ijazah_tahun', 'employees.jabatan_tugas', 'employees.tempat_lahir', 'employees.tanggal_lahir', 'employees.keterangan', 'det_masterwisma.idwisma', 'det_masterwisma.id_masterwisma')
                ->where('det_masterwisma.idwisma', $id)
                ->orderBy('det_masterwisma.id_masterwisma', 'desc')
                ->get();

            $clients = DB::table('data_klien_wisma')
                ->join('master_kasuses', 'data_klien_wisma.kode_kasus', '=', 'master_kasuses.idkasus')
                ->select(
                    'data_klien_wisma.*',
                    'master_kasuses.idkasus',
                    'master_kasuses.kode',
                    'master_kasuses.namakasus'
                )
                ->where('data_klien_wisma.idwisma', $id)
                ->orderBy('data_klien_wisma.id_klienwisma', 'desc')
                ->get();

                $data = [
                    'tenaga' => $tenaga,
                    'clients' => $clients
                ];

            // return Excel::download(new WismaExport($tenaga, $clients), 'wisma.xlsx');
            return view('exports.wisma',$data);
        }

}
