<div class="mb-3">
    <label>Siswa</label>
    <select name="siswa_id" class="w-full border p-2 rounded">
        @foreach($members as $m)
            <option value="{{ $m->id }}">{{ $m->nama }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Buku</label>
    <select name="kode_buku" class="w-full border p-2 rounded">
        @foreach($buku as $b)
            <option value="{{ $b->kode_buku }}">{{ $b->judul }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Tanggal Pinjam</label>
    <input type="date" name="tanggal_pinjam" class="w-full border p-2 rounded">
</div>

<div class="mb-3">
    <label>Batas Kembali</label>
    <input type="date" name="batas_kembali" class="w-full border p-2 rounded">
</div>