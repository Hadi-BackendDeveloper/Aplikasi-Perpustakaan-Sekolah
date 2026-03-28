@extends('admin.layouts.app')

@section('content')
<h1 class="text-2xl md:text-3xl font-bold text-primary mb-6 text-center flex items-center justify-center gap-2">
    <span class="material-symbols-outlined">dashboard</span>
    Dashboard Admin
</h1>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- MEMBER -->
    <a href="/admin/member" class="block">
        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl hover:-translate-y-1 transition text-center">
            <span class="material-symbols-outlined text-4xl text-primary mb-2">groups</span>
            <h2 class="text-lg font-bold text-primary">Data Member</h2>
            <p class="text-gray-600 mt-2 text-sm">Kelola seluruh member</p>
        </div>
    </a>
    <!-- BUKU -->
    <a href="/admin/buku" class="block">
        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl hover:-translate-y-1 transition text-center"> 
            <span class="material-symbols-outlined text-4xl text-primary mb-2">menu_book</span>   
            <h2 class="text-lg font-bold text-primary">Data Buku</h2>
            <p class="text-gray-600 mt-2 text-sm">Kelola koleksi buku</p>
        </div>
    </a>
    <!-- PEMINJAMAN -->
    <a href="/admin/peminjaman" class="block">
        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl hover:-translate-y-1 transition text-center">   
            <span class="material-symbols-outlined text-4xl text-primary mb-2">assignment</span> 
            <h2 class="text-lg font-bold text-primary">Peminjaman</h2>
            <p class="text-gray-600 mt-2 text-sm">Riwayat peminjaman</p>
        </div>
    </a>
    <!-- KRITIK SARAN -->
    <a href="/admin/kritik" class="block">
        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl hover:-translate-y-1 transition text-center">
            <span class="material-symbols-outlined text-4xl text-primary mb-2">feedback</span>
            <h2 class="text-lg font-bold text-primary">Kritik & Saran</h2>
            <p class="text-gray-600 mt-2 text-sm">Masukan siswa</p>
        </div>
    </a>
    <!-- PENGUMUMAN -->
    <a href="/admin/pengumuman" class="block">
        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl hover:-translate-y-1 transition text-center"> 
            <span class="material-symbols-outlined text-4xl text-primary mb-2">campaign</span>
            <h2 class="text-lg font-bold text-primary">Pengumuman</h2>
            <p class="text-gray-600 mt-2 text-sm">Kelola informasi</p>
        </div>
    </a>
    <!-- TENTANG -->
    <a href="/admin/tentang" class="block">
        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl hover:-translate-y-1 transition text-center">
            <span class="material-symbols-outlined text-4xl text-primary mb-2">info</span>
            <h2 class="text-lg font-bold text-primary">Tentang Kami</h2>
            <p class="text-gray-600 mt-2 text-sm">Kelola tentang kami</p>
        </div>
    </a>
</div>

@endsection