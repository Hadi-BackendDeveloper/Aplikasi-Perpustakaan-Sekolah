<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiwayatController extends Controller
{
    public function index()
    {
        $siswa_id = session('siswa_id');

        // Ambil data peminjaman + join buku
        $riwayat = DB::table('peminjaman')
            ->join('buku', 'peminjaman.kode_buku', '=', 'buku.kode_buku')
            ->where('peminjaman.siswa_id', $siswa_id)
            ->select(
                'buku.gambar',
                'peminjaman.kode_buku',
                'buku.nama_buku as judul',
                'buku.genre',
                'peminjaman.tanggal_pinjam',
                'peminjaman.waktu_pinjam',
                'peminjaman.batas_kembali',
                'peminjaman.tanggal_kembali'
            )
            ->orderBy('peminjaman.tanggal_pinjam', 'desc')
            ->paginate(10);

        // Cek apakah ada buku yang belum dikembalikan
        $belumKembali = DB::table('peminjaman')
            ->where('siswa_id', $siswa_id)
            ->whereNull('tanggal_kembali')
            ->exists();

        return view('siswa.riwayat.index', compact('riwayat', 'belumKembali'));
    }
}