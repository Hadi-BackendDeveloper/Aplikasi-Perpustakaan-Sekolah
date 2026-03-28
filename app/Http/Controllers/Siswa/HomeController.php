<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        if (session('siswa_id')) {
            return redirect()->route('siswa.pustaka');
        }

        $captcha_login = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789'), 0, 5);
        session(['captcha_login' => $captcha_login]);

        $captcha_kritik = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789'), 0, 5);
        session(['captcha_kritik' => $captcha_kritik]);

        $buku = DB::table('buku')
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

        return view('siswa.home', compact('buku', 'captcha_login', 'captcha_kritik'));
    }
}