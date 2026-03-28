<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Buku.php
class Buku extends Model
{
    protected $table = 'buku';
    protected $primaryKey = 'kode_buku';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_buku',
        'nama_buku',
        'gambar',
        'genre',
        'penulis',
        'tahun_terbit',
        'deskripsi',
        'stok'
    ];
}