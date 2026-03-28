<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiswaAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'captcha_login' => 'required'
        ]);

        if ($request->captcha_login != session('captcha_login')) {
            return back()->with('login_error', 'Captcha salah');
        }

        $user = DB::table('members')
            ->where('username', $request->username)
            ->first();

        if (!$user) {
            return back()->with('login_error', 'Username tidak ditemukan');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('login_error', 'Password salah');
        }

        session([
            'siswa_id' => $user->id,
            'nama' => $user->nama
        ]);

        session()->forget('captcha_login');

        return redirect()->route('siswa.pustaka');
    }
}