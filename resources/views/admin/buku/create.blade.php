@extends('admin.layouts.app')
@section('content')
@include('admin.components.form', [
    'title' => 'Tambah Buku',
    'action' => url('/admin/buku'),
    'method' => null,
    'backUrl' => url('/admin/buku'),
    'content' => view('admin.buku._fields', [
        'buku' => null,
        'kode' => $kode
    ])->render()
])
@endsection
<script>
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('preview');
    if (input.files && input.files[0]) {
        preview.src = URL.createObjectURL(input.files[0]);
        preview.classList.remove('hidden');
    }
}
</script>