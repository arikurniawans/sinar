<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterKasus;

class MasterKasusController extends Controller
{
    //
    public function index()
    {
        // Ambil data pegawai dengan status = 2 dan urutkan secara descending berdasarkan kolom 'id'
        $data = [
            'title' => 'Master Data Kasus',
            'subtitle' => 'Tabel Master Data Kasus',
            'data' => MasterKasus::orderBy('idkasus', 'desc')->get(),
            'breadcrumb' => [
                ['url' => 'masterkasus.index' , 'name' => 'Master Data kasus'],
            ],
        ];

        return view('masterkasus.index', $data);
        // dd($data['data']);
    }

    public function add()
    {
        $data = [
            'title' => 'Data Master Kasus',
            'subtitle' => 'Input Data Master Kasus',
            'breadcrumb' => [
                ['url' => 'dashboard' , 'name' => 'Dashboard Aplikasi'],
                ['url' => 'pegawai.index' , 'name' => 'Data Master Kasus'],
                ['url' => 'pegawai.add' , 'name' => 'Input Data Master Kasus'],
            ],
        ];

        return view('masterkasus.add', $data);

    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'kode' => 'required|string|max:255',
            'namakasus' => 'required|string|max:255',
            // Tambahkan validasi lain sesuai kebutuhan
        ], [
            'kode.required' => 'Kode harus diisi.',
            'kode.string' => 'Kode harus berupa teks.',
            'kode.max' => 'Kode tidak boleh lebih dari 255 karakter.',
            'namakasus.required' => 'Nama kasus harus diisi.',
            'namakasus.string' => 'Nama kasus harus berupa teks.',
            'namakasus.max' => 'Nama kasus tidak boleh lebih dari 255 karakter.',
        ]);

        // Cek jika nama kasus sudah ada
        if (MasterKasus::where('kode', $request->kode)->exists()) {
            return redirect()->back()->withErrors(['kode' => 'Data kasus sudah ada.'])->withInput();
        }

        // Simpan data ke dalam database
        MasterKasus::create([
            'kode' => $request->kode,
            'namakasus' => $request->namakasus,
            // Tambahkan field lain sesuai kebutuhan
        ]);

        return redirect()->route('masterkasus.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // Ambil data kasus berdasarkan ID
        $kasus = MasterKasus::findOrFail($id);

        $data = [
            'title' => 'Edit Data Master Kasus',
            'subtitle' => 'Edit Data Master Kasus',
            'kasus' => $kasus,
            'breadcrumb' => [
                ['url' => 'masterkasus.index' , 'name' => 'Master Data Kasus'],
            ],
        ];

        return view('masterkasus.edit', $data);
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'kode' => 'required|string|max:255',
            'namakasus' => 'required|string|max:255',
            // Tambahkan validasi lain sesuai kebutuhan
        ], [
            'kode.required' => 'Kode harus diisi.',
            'kode.string' => 'Kode harus berupa teks.',
            'kode.max' => 'Kode tidak boleh lebih dari 255 karakter.',
            'namakasus.required' => 'Nama kasus harus diisi.',
            'namakasus.string' => 'Nama kasus harus berupa teks.',
            'namakasus.max' => 'Nama kasus tidak boleh lebih dari 255 karakter.',
        ]);

        // Ambil data kasus berdasarkan ID
        $kasus = MasterKasus::findOrFail($id);

        // Cek jika nama kasus sudah ada dan bukan milik kasus yang sedang diedit
        if (MasterKasus::where('kode', $request->kode)->exists()) {
            return redirect()->back()->withErrors(['kode' => 'Data kasus sudah ada.'])->withInput();
        }

        // Perbarui data kasus
        $kasus->update([
            'kode' => $request->kode,
            'namakasus' => $request->namakasus,
            // Tambahkan field lain sesuai kebutuhan
        ]);

        return redirect()->route('masterkasus.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Ambil data kasus berdasarkan ID
        $kasus = MasterKasus::findOrFail($id);

        // Hapus data kasus
        $kasus->delete();

        // Mengubah response menjadi JSON
        return response()->json(['message' => 'Data berhasil dihapus.']);
    }


}
