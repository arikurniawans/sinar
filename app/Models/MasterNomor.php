<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterNomor extends Model
{
    use HasFactory;

    protected $primaryKey = 'idnomor';
    protected $fillable = ['nomor_yayasan'];
}
