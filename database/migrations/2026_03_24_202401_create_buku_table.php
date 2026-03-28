<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('buku', function (Blueprint $table) {

            // PRIMARY KEY (STRING)
            $table->string('kode_buku', 20)->primary();

            // DATA UTAMA
            $table->string('nama_buku');
            $table->string('gambar')->nullable();
            $table->string('genre')->nullable();
            $table->string('penulis')->nullable();

            $table->year('tahun_terbit')->nullable();

            $table->text('deskripsi')->nullable();

            $table->integer('stok')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};