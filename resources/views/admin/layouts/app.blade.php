<html>
<head>
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    @vite('resources/css/app.css')
</head>
<body class="bg-accent1 min-h-screen flex flex-col">

<!-- NAVBAR -->
@include('admin.components.navbar')

<!-- CONTENT -->
<main class="min-h-screen bg-linear-to-br from-indigo-500 to-indigo-700 py-8 px-4">
    <div class="max-w-6xl mx-auto">
        @yield('content')
    </div>
</main>

<!-- FOOTER -->
@include('admin.components.footer')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// ================= DELETE BULK =================
function confirmBulkDelete() {
    const checked = document.querySelectorAll('input[name="ids[]"]:checked');

    if (checked.length === 0) {
        Swal.fire('Warning', 'Pilih minimal 1 data!', 'warning');
        return;
    }

    Swal.fire({
        title: 'Yakin hapus?',
        text: checked.length + ' data akan dihapus',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('bulkForm').submit();
        }
    });
}

// ================= DETAIL =================
function showDetail(data) {
    let html = '';

    for (const key in data) {
        html += `<div style="text-align:left">
                    <b>${key}</b> : ${data[key] ?? '-'}
                </div>`;
    }
    Swal.fire({
        title: 'Detail Data',
        html: html
    });
}

// ================= CHECK ALL =================
document.getElementById('checkAll')?.addEventListener('click', function() {
    document.querySelectorAll('input[name="ids[]"]').forEach(cb => {
        cb.checked = this.checked;
    });
});

function showImage(src) {
    document.getElementById('modalImage').src = src;
    const modal = document.getElementById('imageModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeImage() {
    const modal = document.getElementById('imageModal');
    modal.classList.remove('flex');
    modal.classList.add('hidden');
}

// klik background untuk close
document.getElementById('imageModal')?.addEventListener('click', function(e) {
    if (e.target.id === 'imageModal') {
        closeImage();
    }
});
</script>
</body>
</html>