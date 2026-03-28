@extends('admin.layouts.app')

@section('content')

@include('admin.components.form', [
    'title' => 'Tambah Member',
    'action' => url('/admin/member'),
    'method' => null,
    'backUrl' => url('/admin/member'),
    'content' => view('admin.member._fields', [
        'member' => null
    ])->render()
])

@endsection