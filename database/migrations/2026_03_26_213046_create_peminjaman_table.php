<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();

            // DATA SISWA
            $table->unsignedBigInteger('siswa_id');
            $table->string('nama_siswa');
            $table->string('kelas');
            $table->string('jurusan');

            // DATA BUKU
            $table->string('kode_buku');
            $table->string('judul');
            $table->string('genre');
            $table->string('penulis');
            $table->string('tahun_terbit');

            // TANGGAL
            $table->date('tanggal_pinjam');
            $table->time('waktu_pinjam');
            $table->date('batas_kembali');
            $table->date('tanggal_kembali')->nullable();

            $table->timestamps();

            // OPTIONAL RELATION (kalau mau strict)
            // $table->foreign('siswa_id')->references('id')->on('members')->onDelete('cascade');
            // $table->foreign('buku_id')->references('id')->on('buku')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};