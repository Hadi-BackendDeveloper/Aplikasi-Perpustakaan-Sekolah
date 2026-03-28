@extends('siswa.layouts.app')

@section('content')
<div class="min-h-screen flex flex-col">
<div class="grow flex items-center justify-center px-4 py-8">
    <div class="w-full max-w-xl bg-white rounded-2xl shadow-lg p-6">
        <h2 class="text-2xl font-bold text-center mb-6 text-[rgb(61,61,61)]">
            Profil Siswa
        </h2>
        {{-- NOTIF --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif
        {{-- DATA --}}
        <div class="space-y-4 text-sm">
            <div>
                <p class="text-gray-500">Nama</p>
                <p class="font-semibold text-lg">{{ $siswa->nama }}</p>
            </div>
            <div>
                <p class="text-gray-500">Username</p>
                <p class="font-semibold text-lg">{{ $siswa->username }}</p>
            </div>
            <div>
                <p class="text-gray-500">Jenis Kelamin</p>
                <p class="font-semibold text-lg">{{ $siswa->jenis_kelamin }}</p>
            </div>
            <div>
                <p class="text-gray-500">Agama</p>
                <p class="font-semibold text-lg">{{ $siswa->agama }}</p>
            </div>
            <div>
                <p class="text-gray-500">Kelas</p>
                <p class="font-semibold text-lg">{{ $siswa->kelas }}</p>
            </div>
            <div>
                <p class="text-gray-500">Jurusan</p>
                <p class="font-semibold text-lg">{{ $siswa->jurusan }}</p>
            </div>
            <div>
                <p class="text-gray-500">Alamat</p>
                <p class="font-semibold text-lg">{{ $siswa->alamat }}</p>
            </div>
            <div>
                <p class="text-gray-500">No. Telepon</p>
                <p class="font-semibold text-lg">{{ $siswa->no_telp }}</p>
            </div>
        </div>
        {{-- BUTTON --}}
        <div class="mt-6">
            <button onclick="openModal()"
                class="w-full bg-[rgb(61,203,108)] text-white py-2 rounded-lg hover:opacity-90 transition cursor-pointer">
                Edit Profil
            </button>
        </div>
    </div>
</div>
</div>
{{-- MODAL --}}
<div id="modalEdit"
    class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div id="modalContent"
        class="bg-white rounded-xl p-6 w-full max-w-md scale-90 opacity-0 transition duration-300">
        <h3 class="text-lg font-bold mb-4 text-center">Edit Profil</h3>
        <form action="{{ route('siswa.profil.update') }}" method="POST">
            @csrf
            {{-- NAMA --}}
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="nama"
                    value="{{ $siswa->nama }}"
                    class="w-full border p-2 rounded mt-1">
            </div>
            {{-- USERNAME --}}
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username"
                    value="{{ $siswa->username }}"
                    class="w-full border p-2 rounded mt-1">
            </div>
            {{-- JENIS KELAMIN --}}
            <div class="mb-3">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="w-full border p-2 rounded mt-1">
                    <option {{ $siswa->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option {{ $siswa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            {{-- AGAMA --}}
            <div class="mb-3">
                <label>Agama</label>
                <select name="agama" class="w-full border p-2 rounded mt-1">
                    @foreach(['Islam','Kristen','Katolik','Budha','Hindu','Konghuchu'] as $agama)
                        <option {{ $siswa->agama == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                    @endforeach
                </select>
            </div>
            {{-- KELAS --}}
            <div class="mb-3">
                <label>Kelas</label>
                <select name="kelas" class="w-full border p-2 rounded mt-1">
                    @foreach(['X','XI','XII'] as $kelas)
                        <option {{ $siswa->kelas == $kelas ? 'selected' : '' }}>{{ $kelas }}</option>
                    @endforeach
                </select>
            </div>
            {{-- JURUSAN --}}
            <div class="mb-3">
                <label>Jurusan</label>
                <select name="jurusan" class="w-full border p-2 rounded mt-1">
                    @foreach([
                        'Akuntansi Keuangan dan Lembaga',
                        'Bisnis Daring dan Pemasaran',
                        'Rekayasa Perangkat Lunak'
                    ] as $jurusan)
                        <option {{ $siswa->jurusan == $jurusan ? 'selected' : '' }}>
                            {{ $jurusan }}
                        </option>
                    @endforeach
                </select>
            </div>
            {{-- ALAMAT --}}
            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat"
                    class="w-full border p-2 rounded mt-1 resize-none"
                    rows="3">{{ $siswa->alamat }}</textarea>
            </div>
            {{-- NO TELP --}}
            <div class="mb-3">
                <label>No. Telepon</label>
                <input type="number" name="no_telp"
                    value="{{ $siswa->no_telp }}"
                    maxlength="13"
                    oninput="this.value=this.value.slice(0,13)"
                    class="w-full border p-2 rounded mt-1">
            </div>
            {{-- PASSWORD --}}
            <div class="mb-3">
                <label>Password (opsional)</label>
                <input type="password" name="password"
                    placeholder="Kosongkan jika tidak diubah"
                    class="w-full border p-2 rounded mt-1">
            </div>
            <div class="flex gap-2 mt-4">
                <button type="button" onclick="closeModal()"
                    class="w-1/2 bg-gray-300 py-2 rounded">
                    Batal
                </button>
                <button type="submit"
                    class="w-1/2 bg-[rgb(61,203,108)] text-white py-2 rounded cursor-pointer">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
{{-- SCRIPT --}}
<script>
function openModal() {
    const modal = document.getElementById('modalEdit');
    const content = document.getElementById('modalContent');

    modal.classList.remove('hidden');
    modal.classList.add('flex');

    setTimeout(() => {
        content.classList.remove('scale-90', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
    }, 50);
}
function closeModal() {
    const modal = document.getElementById('modalEdit');
    const content = document.getElementById('modalContent');

    content.classList.add('scale-90', 'opacity-0');

    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 200);
}
</script>
@endsection