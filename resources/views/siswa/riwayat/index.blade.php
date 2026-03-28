@extends('siswa.layouts.app')

@section('content')
<div class="min-h-screen flex flex-col">

<div class="grow max-w-7xl mx-auto px-4 py-6">

    <h1 class="text-2xl md:text-3xl font-bold text-[rgb(61,61,61)] flex justify-center items-center gap-2 mb-4">
        RIWAYAT PEMINJAMAN
    </h1>

    {{-- NOTIF --}}
    @if($belumKembali)
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4 shadow">
            <span class="font-semibold">Ada buku yang belum kamu kembalikan</span>, jika buku dikembalikan melewati batas tanggal pengembalian maka akan dikenakan denda Rp.10.000 / hari, berlaku akumulasi.
        </div>
    @endif

    {{-- TABLE --}}
    <div class="overflow-x-auto bg-white shadow rounded-xl">
        <table class="min-w-full text-sm">
            <thead class="bg-[rgb(61,203,108)] text-white">
                <tr>
                    <th class="p-3">Gambar</th>
                    <th class="p-3">Kode Buku</th>
                    <th class="p-3">Judul</th>
                    <th class="p-3">Genre</th>
                    <th class="p-3">Tanggal Peminjaman</th>
                    <th class="p-3">Waktu</th>
                    <th class="p-3">Batas Pengembalian</th>
                    <th class="p-3">Tanggal Pengembalian</th>
                </tr>
            </thead>

            <tbody>
                @forelse($riwayat as $item)
                    <tr class="text-center border-b hover:bg-gray-50 transition">

                        {{-- GAMBAR --}}
                        <td class="p-3">
                            <img src="{{ asset('storage/' . $item->gambar) }}"
                                class="w-16 h-20 object-cover mx-auto rounded cursor-pointer hover:scale-105 transition"
                                onclick="showImage('{{ asset('storage/' . $item->gambar) }}')">
                        </td>

                        <td class="p-3">{{ $item->kode_buku }}</td>
                        <td class="p-3">{{ $item->judul }}</td>
                        <td class="p-3">{{ $item->genre }}</td>

                        {{-- FORMAT TANGGAL --}}
                        <td class="p-3">
                            {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->translatedFormat('d F Y') }}
                        </td>

                        <td class="p-3">{{ $item->waktu_pinjam }}</td>

                        <td class="p-3">
                            {{ \Carbon\Carbon::parse($item->batas_kembali)->translatedFormat('d F Y') }}
                        </td>

                        <td class="p-3">
                            @if(!$item->tanggal_kembali)
                                <span class="bg-red-100 text-red-700 p-2 rounded font-semibold">
                                    Buku Belum Dikembalikan
                                </span>
                            @else
                                {{ \Carbon\Carbon::parse($item->tanggal_kembali)->translatedFormat('d F Y') }}
                            @endif
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="p-4 text-center text-gray-500">
                            Kamu belum meminjam buku
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{-- PAGINATION --}}
    <div class="mt-4">
        {{ $riwayat->links() }}
    </div>
</div>
</div>

{{-- MODAL GAMBAR --}}
<div id="imageModal"
    class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50">

    <div class="relative transform scale-90 opacity-0 transition duration-300" id="modalContent">

        <img id="modalImage" class="max-h-[80vh] rounded shadow-lg">

        <button onclick="closeImage()"
            class="absolute -top-3 -right-3 bg-white rounded-full px-3 py-1 shadow cursor-pointer">
            X
        </button>

    </div>
</div>

{{-- SCRIPT MODAL --}}
<script>
function showImage(src) {
    const modal = document.getElementById('imageModal');
    const content = document.getElementById('modalContent');
    const img = document.getElementById('modalImage');

    img.src = src;
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    setTimeout(() => {
        content.classList.remove('scale-90', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
    }, 50);
}

function closeImage() {
    const modal = document.getElementById('imageModal');
    const content = document.getElementById('modalContent');

    content.classList.add('scale-90', 'opacity-0');

    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 200);
}
</script>

@endsection