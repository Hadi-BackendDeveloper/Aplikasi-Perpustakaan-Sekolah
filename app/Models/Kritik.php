<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kritik extends Model
{
    protected $table = 'kritik';
    protected $primaryKey = 'id_kritik';

    protected $fillable = [
        'nama',
        'kelas',
        'jurusan',
        'kontak',
        'pesan'
    ];
}