@php $b = $buku ?? null; @endphp
<!-- KODE BUKU -->
<div>
    <label>Kode Buku</label>
    <input type="text"
        value="{{ $b->kode_buku ?? $kode ?? '' }}"
        class="w-full border p-2 rounded bg-gray-100"
        disabled>
</div>
<!-- NAMA BUKU -->
<div>
    <label>Nama Buku</label>
    <input type="text" name="nama_buku"
        value="{{ old('nama_buku', $b->nama_buku ?? '') }}"
        class="w-full border p-2 rounded">
</div>
<!-- GENRE -->
<div>
    <label>Genre</label>
    <input list="genreList" name="genre"
        value="{{ old('genre', $b->genre ?? '') }}"
        class="w-full border p-2 rounded">
    <datalist id="genreList">
        <option>Novel</option>
        <option>Sastra</option>
        <option>Sejarah</option>
        <option>Pelajaran Kejuruan</option>
        <option>Pelajaran Umum</option>
        <option>Biografi</option>
        <option>Fiksi</option>
        <option>Hobi</option>
        <option>Lainnya</option>
    </datalist>
</div>
<!-- PENULIS -->
<div>
    <label>Penulis</label>
    <input type="text" name="penulis"
        value="{{ old('penulis', $b->penulis ?? '') }}"
        class="w-full border p-2 rounded">
</div>
<!-- TAHUN TERBIT -->
<div>
    <label>Tahun Terbit</label>
    <input type="number" name="tahun_terbit"
        value="{{ old('tahun_terbit', $b->tahun_terbit ?? '') }}"
        class="w-full border p-2 rounded">
</div>
<!-- STOK -->
<div>
    <label>Stok</label>
    <input type="number" name="stok"
        value="{{ old('stok', $b->stok ?? '') }}"
        class="w-full border p-2 rounded">
</div>
<!-- GAMBAR -->
<div class="md:col-span-2">
    <label>Gambar Buku</label>

    <input type="file" name="gambar"
        class="w-full border p-2 rounded"
        accept="image/*"
        onchange="previewImage(event)">
    <!-- PREVIEW -->
    <img id="preview"
        src="{{ isset($b->gambar) ? asset('storage/'.$b->gambar) : '' }}"
        class="mt-3 w-32 h-40 object-cover border rounded {{ empty($b->gambar) ? 'hidden' : '' }}">
</div>
<!-- DESKRIPSI -->
<div class="md:col-span-2">
    <label>Deskripsi</label>
    <textarea name="deskripsi"
        class="w-full border p-2 rounded"
        rows="3">{{ old('deskripsi', $b->deskripsi ?? '') }}</textarea>
</div>