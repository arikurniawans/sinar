<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterWisma extends Model
{
    use HasFactory;

    protected $primaryKey = 'idwisma';
    protected $fillable = [
        'nama_wisma',
        'alamat',
        'pembina_wisma',
        'jumlah_kamar',
        'supervisor',
        'jumlah_tmp_tidur',
        'jumlah_tng_purna',
        'jumlah_tng_part',
        'jumlah_anak'
    ];
}
