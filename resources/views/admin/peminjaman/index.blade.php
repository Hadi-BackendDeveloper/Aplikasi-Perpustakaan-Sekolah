@extends('admin.layouts.app')

@section('content')
<div class="p-4">
<h1 class="text-2xl md:text-3xl font-bold text-white mb-6 text-center">
    Kelola Data Peminjaman Buku
</h1>
    {{-- TOOLBAR --}}
    @include('admin.components.toolbar', [
        'createUrl' => null,
        'createText' => null,
    ])
    {{-- TABLE --}}
    @include('admin.components.table', [
        'data' => $data,
        'columns' => [
            'Nama Siswa',
            'Buku',
            'Tanggal Pinjam',
            'Batas Kembali',
            'Status',
            'Denda'
        ],
        'primaryKey' => 'id',
        'bulkDeleteUrl' => route('admin.peminjaman.bulkDelete'),

        'rowView' => function($row) {
            return view('admin.peminjaman._row', compact('row'))->render();
        },

        'actionView' => function($row) {
            if (!$row->tanggal_kembali) {
                return '
                    <button 
                        onclick="kembalikan('.$row->id.')" 
                        class="bg-green-600 text-white px-2 py-1 rounded hover:bg-green-700">
                        Kembalikan
                    </button>
                ';
            }
            return '<span class="text-gray-400">-</span>';
        }
    ])
</div>
<script>
function kembalikan(id) {
    if (!confirm("Yakin ingin mengembalikan buku ini?")) return;

    fetch(`{{ route('admin.peminjaman.kembalikan', ':id') }}`.replace(':id', id), {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
            "Accept": "application/json"
        }
    })
    .then(async res => {
        let data = null;

        try {
            data = await res.json();
        } catch (e) {}

        if (res.ok && data && data.success) {
            location.reload();
        } else {
            alert(data?.error || "Gagal mengembalikan");
        }
    })
    .catch(err => {
        alert("Terjadi error");
        console.error(err);
    });
}
</script>

@endsection