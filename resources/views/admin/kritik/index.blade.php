@extends('admin.layouts.app')

@section('content')
<div class="p-4">
<h1 class="text-2xl md:text-3xl font-bold text-white mb-6 text-center">
    Kritik dan Saran
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
            'Nama',
            'Kelas',
            'Jurusan',
            'Kontak'
        ],
        'primaryKey' => 'id',
        'bulkDeleteUrl' => null,

        'rowView' => function($row) {
            return view('admin.kritik._row', compact('row'))->render();
        }
        // ❌ TIDAK ADA actionView
    ])

</div>

{{-- MODAL GLOBAL --}}
@include('admin.components.modal', [
    'title' => 'Detail Kritik & Saran'
])

{{-- OVERRIDE FUNCTION DETAIL --}}
<script>
function showDetail(data) {
    const modal = document.getElementById('modal');
    const content = document.getElementById('modalContent');

    let html = `
        <div><b>Nama:</b> ${data.nama}</div>
        <div><b>Kelas:</b> ${data.kelas}</div>
        <div><b>Jurusan:</b> ${data.jurusan}</div>
        <div><b>Kontak:</b> ${data.kontak}</div>
        <div class="mt-2"><b>Pesan:</b></div>
        <div class="bg-gray-100 p-3 rounded">${data.pesan}</div>
    `;

    content.innerHTML = html;

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

// klik background untuk close
document.getElementById('modal')?.addEventListener('click', function(e) {
    if (e.target.id === 'modal') {
        closeModal();
    }
});
</script>

@endsection