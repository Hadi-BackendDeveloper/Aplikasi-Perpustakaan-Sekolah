@extends('admin.layouts.app')
@section('content')
@include('admin.components.form', [
    'title' => 'Edit Buku',
    'action' => url('/admin/buku/'.$buku->kode_buku),
    'method' => 'PUT',
    'backUrl' => url('/admin/buku'),
    'content' => view('admin.buku._fields', [
        'buku' => $buku,
        'kode' => null
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