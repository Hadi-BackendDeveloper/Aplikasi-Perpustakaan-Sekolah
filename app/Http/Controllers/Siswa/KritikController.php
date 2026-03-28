<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Kritik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class KritikController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required',
                'kelas' => 'required',
                'jurusan' => 'required',
                'kontak' => 'required',
                'pesan' => 'required',
                'captcha_kritik' => 'required'
            ]);
            if ($request->captcha_kritik != session('captcha_kritik')) {
                return back()->with('error', 'Captcha salah');
            }
            DB::table('kritik')->insert([
                'nama' => $request->nama,
                'kelas' => $request->kelas,
                'jurusan' => $request->jurusan,
                'kontak' => $request->kontak,
                'pesan' => $request->pesan,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        
            return back()->with('success', 'Kritik & saran berhasil dikirim');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim: ' . $e->getMessage());
        }
    }
}