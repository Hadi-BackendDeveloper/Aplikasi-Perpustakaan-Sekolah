<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $members = Member::when($request->search, function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('username', 'like', '%' . $request->search . '%');
            });
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

        return view('admin.member.index', compact('members'));
    }

    public function create()
    {
        return view('admin.member.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:members,username',
            'password' => 'required|min:5',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required',
            'kelas' => 'required|in:X,XI,XII',
            'jurusan' => 'required|in:Akuntansi Keuangan & Lembaga,Bisnis Daring dan Pemasaran,Rekayasa Perangkat Lunak',
            'alamat' => 'required',
            'no_telp' => 'required|max:13',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        Member::create($data);

        return redirect('/admin/member')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return view('admin.member.edit', compact('member'));
    }

  public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:members,username,' . $id,
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required',
            'kelas' => 'required|in:X,XI,XII',
            'jurusan' => 'required|in:Akuntansi Keuangan & Lembaga,Bisnis Daring dan Pemasaran,Rekayasa Perangkat Lunak',
            'alamat' => 'required',
            'no_telp' => 'required|max:13',

            // ⚠️ KHUSUS EDIT
            'password' => 'nullable|min:5',
        ]);

        $data = $request->all();

        // ✅ hanya update password jika diisi
        if ($request->password) {
            $data['password'] = \Illuminate\Support\Facades\Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $member->update($data);

        return redirect('/admin/member')->with('success', 'Data berhasil diupdate');
    }
    public function destroy($id)
    {
        Member::findOrFail($id)->delete();
        return back()->with('success', 'Data dihapus');
    }

    public function deleteMultiple(Request $request)
    {
        if (!$request->ids) {
            return back()->with('error', 'Pilih data terlebih dahulu');
        }

        Member::whereIn('id', $request->ids)->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}