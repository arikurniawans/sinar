<?php

namespace App\Http\Controllers;

use App\Models\DataBinaan;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data = [
            'jumlah_pegawai_tetap' => Employee::where('status', 1)->count(),
            'jumlah_pegawai_tidak_tetap' => Employee::where('status', 2)->count(),
            'jumlah_binaan' => DataBinaan::count(),
            'jumlah_penghuni' => DB::table('data_klien_wisma')->count()
        ];
        return view('dashboard.index', $data); // Pastikan view ini sudah ada
    }
}
