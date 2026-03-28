@extends('siswa.layouts.app')
@section('content')
<!-- ================= CAROUSEL ================= -->
<div class="max-w-6xl mx-auto px-4 mt-4">
    <div class="relative overflow-hidden rounded-xl shadow">
        <div id="carousel" class="flex transition-transform duration-700">
            <img src="https://kangacel.id/wp-content/uploads/2024/07/IMG-20230303-WA0014.jpg"
                class="w-full h-[250px] md:h-[350px] object-cover flex-shrink-0">
            <img src="https://smkn1mojosongo.sch.id/webv1/wp-content/uploads/2022/07/DSC0052-1024x682.jpg"
                class="w-full h-[250px] md:h-[350px] object-cover flex-shrink-0">
            <img src="https://smktexmacopemalang.sch.id/wp-content/uploads/2025/05/library-rak.webp"
                class="w-full h-[250px] md:h-[350px] object-cover flex-shrink-0">
            <img src="https://assets.promediateknologi.id/crop/0x0:0x0/0x0/webp/photo/krjogja/site/2022/07/28/410027/perpustakaan-sekolah-belum-semua-terakreditasi-220728k.jpg"
                class="w-full h-[250px] md:h-[350px] object-cover flex-shrink-0">
        </div>
        <!-- BUTTON -->
        <button onclick="prevSlide()"
            class="absolute left-2 top-1/2 -translate-y-1/2 bg-black/50 text-white px-3 py-1 rounded">‹</button>
        <button onclick="nextSlide()"
            class="absolute right-2 top-1/2 -translate-y-1/2 bg-black/50 text-white px-3 py-1 rounded">›</button>
    </div>
</div>
<!-- ================= MENU ================= -->
<div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-4 mt-6 px-4">
    <button onclick="scrollToForm()" class="bg-white shadow p-4 rounded hover:bg-gray-100 cursor-pointer">
        Kritik & Saran
    </button>
    <div class="bg-white shadow p-4 rounded text-center cursor-pointer">
        Pengumuman
    </div>
    <div class="bg-white shadow p-4 rounded text-center cursor-pointer">
        Tentang Kami
    </div>
</div>
<!-- ================= HASIL SEARCH ================= -->
<div id="hasilSearch" class="max-w-6xl mx-auto mt-10 px-4 text-center">
    @if(request('search'))
        <div class="bg-[rgb(61,203,108)] text-white text-center py-2 rounded mb-4">
            Hasil Pencarian Buku
        </div>
        <div class="flex justify-center">
            <div class="grid grid-cols-2 md:grid-cols-1 gap-6">
                @foreach($hasilSearch as $buku)
                    <div class="bg-white p-3 rounded shadow w-full max-w-[220px] mx-auto">
                        <img src="{{ asset('storage/'.$buku->gambar) }}"
                            class="h-40 w-full object-cover mb-2">
                        <div class="font-bold">{{ $buku->nama_buku }}</div>
                        <div class="text-sm">{{ $buku->penulis }}</div>
                        <button onclick="openModal()"
                            class="mt-2 w-full bg-[rgb(61,203,108)] text-white py-1 rounded hover:opacity-90 cursor-pointer">
                            Pinjam Buku
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
<!-- ================= BUKU TERBARU ================= -->
<div class="max-w-6xl mx-auto mt-10 px-4 text-center">
    <div class="bg-[rgb(61,203,108)] text-white text-center py-2 rounded mb-4">
        Koleksi Buku Terbaru
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach($buku as $item)
            <div class="bg-white p-3 rounded shadow text-left w-full">
                <img src="{{ asset('storage/'.$item->gambar) }}"
                    class="h-40 w-full object-cover mb-2">
                <div class="font-bold">{{ $item->nama_buku }}</div>
                <div class="text-sm">{{ $item->penulis }}</div>
                <p class="text-sm text-gray-600 mt-1 h-[60px] overflow-hidden">
                    {{ \Illuminate\Support\Str::words($item->deskripsi, 20, '...') }}
                </p>
                <button onclick="openModal()"
                    class="mt-2 w-full bg-[rgb(61,203,108)] text-white py-1 rounded hover:opacity-90 cursor-pointer">
                    Pinjam Buku
                </button>
            </div>
        @endforeach
    </div>
</div>
<!-- ================= FORM ================= -->
<div id="formKritik" class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <div class="bg-[rgb(61,203,108)] text-white text-center py-2 rounded mb-4">
        Kritik & Saran Siswa
    </div>
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
            {{ $errors->first() }}
        </div>
    @endif
    <form action="{{ route('kritik.store') }}" method="POST">
    @csrf
        <div class="grid md:grid-cols-2 gap-4">
            <input type="text" name="nama"
                placeholder="Nama"
                class="border p-2 rounded w-full" required>
            <select name="kelas" class="border p-2 rounded w-full" required>
                <option value="">Pilih Kelas</option>
                <option>X</option>
                <option>XI</option>
                <option>XII</option>
            </select>
            <select name="jurusan" class="border p-2 rounded w-full" required>
                <option value="">Pilih Jurusan</option>
                <option>Akuntasi Keuangan & Lembaga</option>
                <option>Bisnis Daring dan Pemasaran</option>
                <option>Rekayasa Perangkat Lunak</option>
            </select>
            <input type="text" name="kontak" maxlength="13"
                oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                placeholder="Kontak"
                class="border p-2 rounded w-full" required>
        </div>
        <textarea name="pesan"
            placeholder="Pesan"
            class="border p-2 rounded w-full mt-4 resize-none"
            rows="4" required></textarea>
            <div class="mt-4 text-left">
                <label class="block mb-1 font-semibold">Captcha</label>
                <div class="flex items-center gap-3">
                    <div class="bg-gray-200 px-4 py-2 rounded font-bold tracking-widest">
                        {{ $captcha_kritik }}
                    </div>
                    <input type="text" name="captcha_kritik"
                        class="border p-2 rounded w-full"
                        placeholder="Masukkan captcha" required>
                </div>
            </div>
        <button id="btnKirim"
            class="mt-4 bg-[rgb(61,203,108)] text-white px-4 py-2 rounded opacity-50 cursor-pointer"
            disabled>
            Kirim
        </button>
    </form>
</div>
<!-- ================= MODAL PINJAM ================= -->
<div id="pinjamModal"
    class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div id="modalContent"
        class="bg-white rounded-xl p-6 max-w-md w-full text-center scale-95 opacity-0 transition duration-300">
        <h2 class="text-lg font-semibold mb-3">
            Untuk melakukan peminjaman buku, harap melakukan login terlebih dahulu.
        </h2>
        <button onclick="closeModal()"
            class="mt-4 bg-[rgb(61,203,108)] text-white px-4 py-2 rounded hover:opacity-90 cursor-pointer">
            Kembali
        </button>
    </div>
</div>
@if(session('success'))
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelector('form').reset();
});
</script>
@endif
@include('siswa.components.login-modal')
@endsection
<!-- ================= SCRIPT ================= -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    // ===== CAROUSEL =====
    let index = 0;
    const carousel = document.getElementById('carousel');
    const total = carousel.children.length;
    function showSlide() {
        carousel.style.transform = `translateX(-${index * 100}%)`;
    }
    window.nextSlide = function () {
        index = (index + 1) % total;
        showSlide();
    }
    window.prevSlide = function () {
        index = (index - 1 + total) % total;
        showSlide();
    }
    setInterval(() => {
        nextSlide();
    }, 3000);
    // ===== AUTO SCROLL SEARCH =====
    if (window.location.search.includes('search=')) {
        document.getElementById('hasilSearch')
            ?.scrollIntoView({ behavior: 'smooth' });
    }
});
// ===== SCROLL FORM =====
function scrollToForm() {
    document.getElementById('formKritik')
        .scrollIntoView({ behavior: 'smooth' });
}
// ===== MODAL =====
function openModal() {
    const modal = document.getElementById('pinjamModal');
    const content = document.getElementById('modalContent');

    modal.classList.remove('hidden');

    setTimeout(() => {
        modal.classList.add('flex');
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeModal() {
    const modal = document.getElementById('pinjamModal');
    const content = document.getElementById('modalContent');

    content.classList.remove('scale-100', 'opacity-100');
    content.classList.add('scale-95', 'opacity-0');

    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 200);
}
document.addEventListener("DOMContentLoaded", function () {

    const captchaInput = document.querySelector('input[name="captcha_kritik"]');
    const btn = document.getElementById('btnKirim');
    const captchaValue = "{{ $captcha_kritik }}".toString().trim();

    captchaInput.addEventListener('input', function () {

        const inputValue = this.value.toString().trim();

        if (inputValue === captchaValue) {
            btn.disabled = false;
            btn.classList.remove('opacity-50','cursor-not-allowed');
        } else {
            btn.disabled = true;
            btn.classList.add('opacity-50','cursor-not-allowed');
        }

    });

});

function openLoginModal() {
    const modal = document.getElementById('loginModal');
    const content = document.getElementById('loginContent');

    modal.classList.remove('hidden');

    setTimeout(() => {
        modal.classList.add('flex');
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeLoginModal() {
    const modal = document.getElementById('loginModal');
    const content = document.getElementById('loginContent');

    content.classList.remove('scale-100', 'opacity-100');
    content.classList.add('scale-95', 'opacity-0');

    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 200);
}
</script>