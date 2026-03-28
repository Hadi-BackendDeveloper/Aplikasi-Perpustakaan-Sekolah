<div class="flex flex-col md:flex-row justify-between items-center gap-3 mb-4">

    {{-- LEFT: BUTTON --}}
    <div class="flex gap-2">

        {{-- TOMBOL TAMBAH (OPTIONAL) --}}
        @if(!empty($createText) && !empty($createUrl))
        <a href="{{ $createUrl }}"
            class="flex items-center gap-1 bg-primary hover:bg-secondary text-white px-4 py-2 rounded cursor-pointer transition">
            <span class="material-symbols-outlined">
                add_circle
            </span>
            {{ $createText }}
        </a>
        @endif

        {{-- BULK DELETE --}}
        <button type="button"
            class="flex items-center gap-1 bg-red-800 hover:bg-red-600 text-white px-4 py-2 rounded cursor-pointer transition"
            onclick="confirmBulkDelete()">
            <span class="material-symbols-outlined">
                delete
            </span>
            Hapus
        </button>

    </div>

    {{-- RIGHT: SEARCH --}}
    <form method="GET" class="flex items-center gap-2">
        <div class="flex items-center border rounded px-2 py-1 bg-white">
            <span class="material-symbols-outlined">
                document_search
            </span>
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari data..."
                class="outline-none px-2 py-1 w-64 md:w-72">
        </div>
        <button
            class="flex items-center gap-1 bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded transition cursor-pointer">
            <span class="material-symbols-outlined">
                search
            </span>
            Cari
        </button>
    </form>
</div>