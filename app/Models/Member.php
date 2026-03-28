<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'agama',
        'kelas',
        'jurusan',
        'alamat',
        'no_telp',
        'username',
        'password'
    ];
}
