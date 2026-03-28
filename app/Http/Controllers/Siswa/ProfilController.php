<?php

namespace App\Http\Controllers\Siswa;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index()
    {
        $siswa_id = session('siswa_id');

        $siswa = DB::table('members')
            ->where('id', $siswa_id)
            ->first();

        return view('siswa.profil.index', compact('siswa'));
    }

    public function update(Request $request)
    {
        $siswa_id = session('siswa_id');

        $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:members,username,' . $siswa_id,
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|in:Islam,Kristen,Katolik,Budha,Hindu,Konghuchu',
            'kelas' => 'required|in:X,XI,XII',
            'jurusan' => 'required|in:Akuntansi Keuangan dan Lembaga,Bisnis Daring dan Pemasaran,Rekayasa Perangkat Lunak',
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|digits_between:10,13',
            'password' => 'nullable|min:6'
        ]);

        $data = [
            'nama' => $request->nama,
            'username' => $request->username,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
        ];

        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        DB::table('members')
            ->where('id', $siswa_id)
            ->update($data);

        return back()->with('success', 'Profil berhasil diperbarui');
    }
}