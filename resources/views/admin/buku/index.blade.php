@extends('admin.layouts.app')
@section('content')
<h1 class="text-2xl md:text-3xl font-bold text-white mb-6 text-center">
    Kelola Data Buku
</h1>
@include('admin.components.toolbar', [
    'createUrl' => '/admin/buku/create',
    'createText' => 'Tambah Buku'
])
@include('admin.components.table', [
    'data' => $bukus,
    'columns' => ['Gambar','Kode','Nama Buku','Penulis','Stok'],
    'primaryKey' => 'kode_buku',
    'bulkDeleteUrl' => '/admin/buku/delete-multiple',
    //  WAJIB ADA
    'rowView' => function($row) {
        return view('admin.buku._row', compact('row'))->render();
    },
    'editUrl' => fn($row) => "/admin/buku/$row->kode_buku/edit",
    'deleteUrl' => fn($row) => "/admin/buku/$row->kode_buku"
])
<div id="imageModal" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50">
    <span onclick="closeImage()"
        class="absolute top-5 right-5 text-white text-3xl cursor-pointer">&times;</span>
    <img id="modalImage"
       class="max-h-[80vh] max-w-[90vw] object-contain rounded-lg shadow-lg">
</div>
@endsection