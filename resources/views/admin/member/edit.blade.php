@extends('admin.layouts.app')

@section('content')

@include('admin.components.form', [
    'title' => 'Edit Member',
    'action' => url('/admin/member/'.$member->id),
    'method' => 'PUT',
    'backUrl' => url('/admin/member'),
    'content' => view('admin.member._fields', [
        'member' => $member
    ])->render()
])

@endsection