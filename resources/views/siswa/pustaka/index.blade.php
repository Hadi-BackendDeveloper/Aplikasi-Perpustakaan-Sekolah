@extends('siswa.layouts.app') {{-- sesuaikan dengan layout kamu --}}
@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
     <!-- HEADER CENTER -->
    <div class="text-center mb-8">
        <!-- HEADING -->
        <h1 class="text-2xl md:text-3xl font-bold text-[rgb(61,61,61)] flex justify-center items-center gap-2 mb-4">
            KOLEKSI BUKU PERPUSTAKAAN SMK SMK INSAN GLOBAL
        </h1>

        <!-- SEARCH -->
        <form method="GET" action="{{ route('siswa.pustaka') }}"
            class="flex justify-center">

            <div class="flex items-center border rounded-lg px-3 py-2 w-full max-w-md shadow-sm">
                <span class="material-symbols-outlined text-gray-500">
                    search
                </span>

                <input type="text" name="search" value="{{ $search }}"
                    placeholder="Cari judul atau penulis..."
                    class="outline-none px-2 w-full">
            </div>

            <button type="submit"
                class="ml-2 bg-[rgb(61,203,108)] text-white px-4 py-2 rounded-lg hover:opacity-90 cursor-pointer">
                Cari
            </button>
        </form>
    </div>
    @if(session('success'))
        <div id="notif"
            class="max-w-md mx-auto mb-4 bg-green-100 text-green-700 px-4 py-3 rounded shadow text-center">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div id="notif"
            class="max-w-md mx-auto mb-4 bg-red-100 text-red-700 px-4 py-3 rounded shadow text-center">
            {{ session('error') }}
        </div>
    @endif
    <!-- GRID BUKU -->
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
        @forelse($buku as $item)
            <div class="bg-white rounded-xl shadow p-3 flex flex-col">
                <!-- GAMBAR -->
                <img src="{{ asset('storage/' . $item->gambar) }}"
                    class="w-full h-48 object-contain bg-white rounded mb-3">
                <!-- INFO -->
                <h2 class="font-semibold text-sm mb-1 line-clamp-2">
                    {{ $item->nama_buku }}
                </h2>
                <p class="text-xs text-gray-500 mb-1">
                    {{ $item->penulis }}
                </p>
                <span class="text-xs bg-gray-200 px-2 py-1 rounded w-fit mb-3">
                    {{ $item->genre }}
                </span>
                <!-- BUTTON -->
                <button onclick="openModal('{{ $item->kode_buku }}')"
                    class="mt-auto bg-[rgb(61,203,108)] text-white text-sm py-2 rounded hover:opacity-90 cursor-pointer">
                    Pinjam
                </button>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500">
                Data buku tidak ditemukan
            </p>
        @endforelse
    </div>
    <!-- PAGINATION -->
    <div class="mt-6">
        {{ $buku->links() }}
    </div>
</div>
{{-- MODAL PINJAM --}}
<div id="modalPinjam"
    class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 transition-opacity duration-300">
    <div id="modalBox"
        class="bg-white w-full max-w-3xl rounded-xl p-6 relative transform scale-90 opacity-0 transition-all duration-300">
        <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-500 text-lg cursor-pointer">
            ✕
        </button>
        <div class="flex gap-6">
            <div class="w-1/3 flex justify-center items-center bg-gray-100 rounded">
                <img id="modalGambar" class="max-h-64 object-contain">
            </div>
            <div class="w-2/3 text-sm">
                <p><b>Kode:</b> <span id="modalKode"></span></p>
                <p><b>Judul:</b> <span id="modalJudul"></span></p>
                <p><b>Genre:</b> <span id="modalGenre"></span></p>
                <p><b>Penulis:</b> <span id="modalPenulis"></span></p>
                <p><b>Tahun:</b> <span id="modalTahun"></span></p>
                <p class="mt-2">
                    <b>Deskripsi:</b>
                    <span id="shortDesc"></span>
                    <span id="dots">...</span>
                    <span id="moreDesc" class="hidden"></span>
                    <button onclick="toggleDesc()" class="text-blue-500 text-xs cursor-pointer">
                        lihat selengkapnya
                    </button>
                </p>
                <form method="POST" action="{{ route('siswa.pinjam') }}">
                    @csrf
                    <input type="hidden" name="buku_id" id="buku_id">
                    <div class="text-center mt-4">
                        @if($punyaPinjaman)
                            <button disabled class="bg-gray-400 text-white py-2 px-6 rounded">
                                Selesaikan Pengembalian Buku
                            </button>
                        @else
                        <button type="submit"
                            class="bg-[rgb(61,203,108)] text-white px-6 py-2 rounded hover:opacity-90 cursor-pointer">
                            Pinjam Buku
                        </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
let fullDesc = '';

function openModal(id) {
    const data = @json($buku);
    const buku = data.data.find(b => b.kode_buku === id);

    if (!buku) return;

    const modal = document.getElementById('modalPinjam');
    const box = document.getElementById('modalBox');

    modal.classList.remove('hidden');
    modal.classList.add('flex');

    setTimeout(() => {
        box.classList.remove('scale-90', 'opacity-0');
        box.classList.add('scale-100', 'opacity-100');
    }, 10);

    // isi data
    document.getElementById('modalGambar').src = "{{ asset('storage') }}/" + buku.gambar;
    document.getElementById('modalKode').innerText = buku.kode_buku;
    document.getElementById('modalJudul').innerText = buku.nama_buku;
    document.getElementById('modalGenre').innerText = buku.genre;
    document.getElementById('modalPenulis').innerText = buku.penulis;
    document.getElementById('modalTahun').innerText = buku.tahun_terbit;
    document.getElementById('buku_id').value = buku.kode_buku;

    // deskripsi
    let words = (buku.deskripsi ?? '').split(' ');

    if (words.length > 20) {
        shortDesc.innerText = words.slice(0,20).join(' ');
        moreDesc.innerText = words.slice(20).join(' ');
        dots.style.display = 'inline';
    } else {
        shortDesc.innerText = buku.deskripsi;
        dots.style.display = 'none';
    }
}

function closeModal() {
    const modal = document.getElementById('modalPinjam');
    const box = document.getElementById('modalBox');

    box.classList.remove('scale-100', 'opacity-100');
    box.classList.add('scale-90', 'opacity-0');

    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 200);
}

function toggleDesc() {
    const more = document.getElementById('moreDesc');
    const dots = document.getElementById('dots');

    if (more.classList.contains('hidden')) {
        more.classList.remove('hidden');
        dots.style.display = 'none';
    } else {
        more.classList.add('hidden');
        dots.style.display = 'inline';
    }
}

setTimeout(() => {
    const notif = document.getElementById('notif');
    if (notif) {
        notif.style.transition = '0.5s';
        notif.style.opacity = '0';
        setTimeout(() => notif.remove(), 500);
    }
}, 3000);
</script>
@endsection