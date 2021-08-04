<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip', 'nama', 'jk', 'alamat', 'tempat_lahir', 'tgl_lahir', 'email', 'no_telp'
    ];
}
