@php $m = $member ?? null; @endphp

<!-- NAMA -->
<div>
    <label>Nama</label>
    <input type="text" name="nama"
        value="{{ old('nama', $m->nama ?? '') }}"
        class="w-full border p-2 rounded">
</div>

<!-- USERNAME -->
<div>
    <label>Username</label>
    <input type="text" name="username"
        value="{{ old('username', $m->username ?? '') }}"
        class="w-full border p-2 rounded">
</div>

<!-- JENIS KELAMIN -->
<div>
    <label>Jenis Kelamin</label>
    <select name="jenis_kelamin" class="w-full border p-2 rounded">
        <option value="">Pilih</option>
        <option value="Laki-laki" {{ old('jenis_kelamin', $m->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
        <option value="Perempuan" {{ old('jenis_kelamin', $m->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
    </select>
</div>

<!-- AGAMA -->
<div>
    <label>Agama</label>
    <select name="agama" class="w-full border p-2 rounded">
        <option value="">Pilih</option>
        <option value="Islam" {{ old('agama', $m->agama ?? '') == 'Islam' ? 'selected' : '' }}>Islam</option>
        <option value="Kristen" {{ old('agama', $m->agama ?? '') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
        <option value="Katolik" {{ old('agama', $m->agama ?? '') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
        <option value="Hindu" {{ old('agama', $m->agama ?? '') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
        <option value="Buddha" {{ old('agama', $m->agama ?? '') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
        <option value="Konghucu" {{ old('agama', $m->agama ?? '') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
    </select>
</div>

<!-- KELAS (FIX ENUM) -->
<div>
    <label>Kelas</label>
    <select name="kelas" class="w-full border p-2 rounded">
        <option value="">Pilih</option>
        <option value="X" {{ old('kelas', $m->kelas ?? '') == 'X' ? 'selected' : '' }}>X</option>
        <option value="XI" {{ old('kelas', $m->kelas ?? '') == 'XI' ? 'selected' : '' }}>XI</option>
        <option value="XII" {{ old('kelas', $m->kelas ?? '') == 'XII' ? 'selected' : '' }}>XII</option>
    </select>
</div>

<!-- JURUSAN (FIX SESUAI DATA ASLI) -->
<div>
    <label>Jurusan</label>
    <select name="jurusan" class="w-full border p-2 rounded">
        <option value="">Pilih</option>
        <option value="Akuntansi Keuangan & Lembaga"
            {{ old('jurusan', $m->jurusan ?? '') == 'Akuntansi Keuangan & Lembaga' ? 'selected' : '' }}>
            Akuntansi Keuangan & Lembaga
        </option>

        <option value="Bisnis Daring dan Pemasaran"
            {{ old('jurusan', $m->jurusan ?? '') == 'Bisnis Daring dan Pemasaran' ? 'selected' : '' }}>
            Bisnis Daring dan Pemasaran
        </option>

        <option value="Rekayasa Perangkat Lunak"
            {{ old('jurusan', $m->jurusan ?? '') == 'Rekayasa Perangkat Lunak' ? 'selected' : '' }}>
            Rekayasa Perangkat Lunak
        </option>
    </select>
</div>

<!-- ALAMAT -->
<div class="md:col-span-2">
    <label>Alamat</label>
    <textarea name="alamat"
        class="w-full border p-2 rounded" style="resize: none">{{ old('alamat', $m->alamat ?? '') }}</textarea>
</div>

<!-- NO TELP -->
<div class="md:col-span-2">
    <label>No Telepon</label>
    <input type="text" name="no_telp"
        maxlength="13"
        value="{{ old('no_telp', $m->no_telp ?? '') }}"
        class="w-full border p-2 rounded">
</div>

<!-- PASSWORD -->
<div class="md:col-span-2">
    <label>Password</label>
    <input type="password" name="password"
        class="w-full border p-2 rounded">
</div>