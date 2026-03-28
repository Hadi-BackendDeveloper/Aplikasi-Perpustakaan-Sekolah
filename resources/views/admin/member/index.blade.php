@extends('admin.layouts.app')

@section('content')

<h1 class="text-2xl md:text-3xl font-bold text-white mb-6 text-center">
    Kelola Data Member
</h1>

@include('admin.components.toolbar', [
    'createUrl' => '/admin/member/create',
    'createText' => 'Tambah Member'
])

@include('admin.components.table', [
    'data' => $members,
    'columns' => ['Nama','Username','Kelas','No Telp'],
    'primaryKey' => 'id',
    'bulkDeleteUrl' => '/admin/member/delete-multiple',

    // 🔥 WAJIB (SAMA SEPERTI BUKU)
    'rowView' => function($row) {
        return view('admin.member._row', compact('row'))->render();
    },

    'editUrl' => fn($row) => "/admin/member/$row->id/edit"
])

@endsection