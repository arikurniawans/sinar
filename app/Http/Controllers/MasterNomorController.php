<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterNomor;

class MasterNomorController extends Controller
{
    //
    public function index()
    {
        // Ambil data pegawai dengan status = 2 dan urutkan secara descending berdasarkan kolom 'id'
        $data = [
            'title' => 'Master Data Nomor Induk Yayasan',
            'subtitle' => 'Tabel Master Data Nomor Induk Yayasan',
            'data' => MasterNomor::orderBy('idnomor', 'desc')->get(),
            'breadcrumb' => [
                ['url' => 'masternomor.induk' , 'name' => 'Master Data Nomor Induk Yayasan'],
            ],
        ];

        return view('masternomor.index', $data);
        // dd($data['data']);
    }

    public function add()
    {
        $data = [
            'title' => 'Master Data Nomor Induk Yayasan',
            'subtitle' => 'Input Master Data Nomor Induk Yayasan',
            'breadcrumb' => [
                ['url' => 'masternomor.index' , 'name' => 'Master Data Nomor Induk Yayasan'],
            ],
        ];

        return view('masternomor.add', $data);
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'nomor_yayasan' => 'required|string|max:255',
            // Tambahkan validasi lain sesuai kebutuhan
        ], [
            'nomor_yayasan.required' => 'Nama nomor harus diisi.',
            'nomor_yayasan.max' => 'Nama nomor tidak boleh lebih dari 255 karakter.',
        ]);

        // Cek jika nama nomor sudah ada
        if (MasterNomor::where('nomor_yayasan', $request->nomor_yayasan)->exists()) {
            return redirect()->back()->withErrors(['nomor_yayasan' => 'Data nomor induk yayasan sudah ada.'])->withInput();
        }

        // Simpan data ke dalam database
        MasterNomor::create([
            'nomor_yayasan' => $request->nomor_yayasan,
            // Tambahkan field lain sesuai kebutuhan
        ]);

        return redirect()->route('masternomor.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // Ambil data nomor berdasarkan ID
        $nomor = MasterNomor::findOrFail($id);

        $data = [
            'title' => 'Master Data Nomor Induk Yayasan',
            'subtitle' => 'Edit Master Data Nomor Induk Yayasan',
            'nomor' => $nomor,
            'breadcrumb' => [
                ['url' => 'masternomor.index' , 'name' => 'Master Data Nomor Induk Yayasan'],
            ],
        ];

        return view('masternomor.edit', $data);
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'nomor_yayasan' => 'required|string|max:255',
            // Tambahkan validasi lain sesuai kebutuhan
        ], [
            'nomor_yayasan.required' => 'Nama nomor harus diisi.',
            'nomor_yayasan.max' => 'Nama nomor tidak boleh lebih dari 255 karakter.',
        ]);

        // Ambil data nomor berdasarkan ID
        $nomor = MasterNomor::findOrFail($id);

        // Cek jika nama nomor sudah ada dan bukan milik nomor yang sedang diedit
        if (MasterNomor::where('nomor_yayasan', $request->nomor_yayasan)->exists()) {
            return redirect()->back()->withErrors(['nomor_yayasan' => 'Data nomor induk yayasan sudah ada.'])->withInput();
        }

        // Perbarui data nomor
        $nomor->update([
            'nomor_yayasan' => $request->nomor_yayasan,
            // Tambahkan field lain sesuai kebutuhan
        ]);

        return redirect()->route('masternomor.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Ambil data nomor berdasarkan ID
        $nomor = MasterNomor::findOrFail($id);

        // Hapus data nomor
        $nomor->delete();

        // Mengubah response menjadi JSON
        return response()->json(['message' => 'Data berhasil dihapus.']);
    }

}
