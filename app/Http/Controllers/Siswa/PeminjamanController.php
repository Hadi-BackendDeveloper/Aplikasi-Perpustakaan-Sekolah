<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function store(Request $request)
    {
        $siswa = DB::table('members')
            ->where('id', session('siswa_id'))
            ->first();

        if (!$siswa) {
            return back()->with('error', 'Data siswa tidak ditemukan');
        }

        $cekPinjam = DB::table('peminjaman')
            ->where('siswa_id', $siswa->id)
            ->whereNull('tanggal_kembali')
            ->first();

        if ($cekPinjam) {
            return back()->with('error', 'Kamu perlu mengembalikan buku terlebih dahulu sebelum meminjam buku lainnya');
        }

        $buku = DB::table('buku')
            ->where('kode_buku', $request->buku_id)
            ->first();

        if (!$buku) {
            return back()->with('error', 'Buku tidak ditemukan');
        }

        $tanggal = now();

        DB::table('peminjaman')->insert([
            'siswa_id' => $siswa->id,
            'nama_siswa' => $siswa->nama,
            'kelas' => $siswa->kelas,
            'jurusan' => $siswa->jurusan,

            'kode_buku' => $buku->kode_buku,
            'judul' => $buku->nama_buku,
            'genre' => $buku->genre,
            'penulis' => $buku->penulis,
            'tahun_terbit' => $buku->tahun_terbit,

            'tanggal_pinjam' => $tanggal->toDateString(),
            'waktu_pinjam' => $tanggal->toTimeString(),
            'batas_kembali' => $tanggal->copy()->addDays(7)->toDateString(),
            'tanggal_kembali' => null,
        ]);

        return back()->with('success', 'Peminjaman buku berhasil');
    }
}