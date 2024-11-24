<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterKasus extends Model
{
    use HasFactory;

    protected $table = 'master_kasuses';

    protected $primaryKey = 'idkasus';

    protected $fillable = [
        'kode',
        'namakasus',
    ];
}
