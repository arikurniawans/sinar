<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        'nomor_induk',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'jenis_kelamin',
        'ijazah_tahun',
        'tahun_mulai_bekerja',
        'jabatan_tugas',
        'no_kk',
        'nik',
        'foto',
        'unit',
        'keterangan',
        'status',
    ];

    // Constants for status
    const STATUS_PEGAWAI_TETAP = 1;
    const STATUS_PEGAWAI_TIDAK_TETAP = 2;
}
