<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $query = Buku::query();

        if ($request->search) {
            $query->where('nama_buku', 'like', '%' . $request->search . '%')
                  ->orWhere('penulis', 'like', '%' . $request->search . '%');
        }

        $bukus = $query->latest()->paginate(5)->withQueryString();
        $rowView = 'admin.buku._row';
        return view('admin.buku.index', compact('bukus'));
    }

    // 🔥 AUTO KODE
    private function generateKodeBuku()
    {
        $last = Buku::orderBy('kode_buku', 'desc')->first();

        if (!$last) return 'IG001';

        $num = (int) substr($last->kode_buku, 2);
        return 'IG' . str_pad($num + 1, 3, '0', STR_PAD_LEFT);
    }

    public function create()
    {
        $kode = $this->generateKodeBuku();
        return view('admin.buku.create', compact('kode'));
    }

    public function store(Request $r)
    {
        $r->validate([
            'nama_buku' => 'required',
            'genre' => 'required',
            'penulis' => 'required',
            'tahun_terbit' => 'required|digits:4',
            'deskripsi' => 'required',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|max:2048'
        ]);

        $data = $r->only([
            'nama_buku',
            'genre',
            'penulis',
            'tahun_terbit',
            'deskripsi',
            'stok'
        ]);

        $data['kode_buku'] = $this->generateKodeBuku();

        if ($r->hasFile('gambar')) {
            $data['gambar'] = $r->file('gambar')->store('buku', 'public');
        }

        Buku::create($data);

        return redirect('/admin/buku')->with('success', 'Berhasil ditambah');
    }

    public function edit($kode_buku)
    {
        $buku = Buku::findOrFail($kode_buku);
        return view('admin.buku.edit', compact('buku'));
    }

    public function update(Request $r, $kode_buku)
    {
        $buku = Buku::findOrFail($kode_buku);

        $r->validate([
            'nama_buku' => 'required',
            'genre' => 'required',
            'penulis' => 'required',
            'tahun_terbit' => 'required|digits:4',
            'deskripsi' => 'required',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|max:2048'
        ]);

        $data = $r->only([
            'nama_buku',
            'genre',
            'penulis',
            'tahun_terbit',
            'deskripsi',
            'stok'
        ]);

        if ($r->hasFile('gambar')) {

            if ($buku->gambar && Storage::disk('public')->exists($buku->gambar)) {
                Storage::disk('public')->delete($buku->gambar);
            }

            $data['gambar'] = $r->file('gambar')->store('buku', 'public');
        }

        $buku->update($data);

        return redirect('/admin/buku')->with('success', 'Berhasil diupdate');
    }

    public function destroy($kode_buku)
    {
        $buku = Buku::findOrFail($kode_buku);

        if ($buku->gambar) {
            Storage::disk('public')->delete($buku->gambar);
        }

        $buku->delete();

        return back()->with('success', 'Berhasil dihapus');
    }

    public function deleteMultiple(Request $r)
    {
        Buku::whereIn('kode_buku', $r->ids)->delete();
        return redirect()->back();
    }
}