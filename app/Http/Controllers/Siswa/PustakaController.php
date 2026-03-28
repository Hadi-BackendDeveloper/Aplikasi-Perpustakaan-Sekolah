<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PustakaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $buku = DB::table('buku')
            ->when($search, function ($query, $search) {
                $query->where('nama_buku', 'like', "%$search%")
                        ->orWhere('penulis', 'like', "%$search%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

            $siswaId = session('siswa_id');

            $punyaPinjaman = DB::table('peminjaman')
                ->where('siswa_id', $siswaId)
                ->whereNull('tanggal_kembali')
                ->exists();
                
        return view('siswa.pustaka.index', compact('buku', 'search', 'punyaPinjaman'));
    }
}