<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBinaan extends Model
{
    use HasFactory;

    protected $table = 'data_binaans'; // Nama tabel

    protected $primaryKey = 'idbinaan'; // Menetapkan idbinaan sebagai primary key

    public $incrementing = false; // Non-incrementing jika idbinaan bukan auto-increment

    protected $fillable = [
        'idbinaan', // Tambahkan idbinaan ke dalam fillable
        'nama',
        'nik',
        'no_kk',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat_ktp',
        'rt',
        'rw',
        'dusun',
        'nama_kel',
        'idkel',
        'nama_kec',
        'idkec',
        'nama_kabkot',
        'idkabkot',
        'nama_prop',
        'idprov',
        'ragam_disabilitas',
        'wisma',
        'foto',
        'keterangan',
    ];
}
