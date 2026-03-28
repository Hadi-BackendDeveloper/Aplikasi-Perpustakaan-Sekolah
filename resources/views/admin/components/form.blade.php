<div class="max-w-6xl mx-auto">
    <!-- TITLE -->
    <h1 class="text-2xl md:text-3xl font-bold text-white mb-6 text-center">
        {{ $title }}
    </h1>
    <!-- CARD -->
    <div class="bg-white rounded-xl shadow p-6 max-w-3xl mx-auto">
        <form method="POST" action="{{ $action }}" enctype="multipart/form-data">
            @csrf
            @if(!empty($method))
                @method($method)
            @endif
            <!-- GRID -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {!! $content !!}
            </div>
            <!-- BUTTON -->
            <div class="mt-6 flex justify-between items-center">
                <a href="{{ $backUrl }}"
                    class="bg-gray-300 px-4 py-2 rounded-lg hover:bg-gray-400">
                    Kembali
                </a>
                <button type="submit"
                    class="bg-primary text-white px-6 py-2 rounded-lg flex items-center gap-2 hover:bg-secondary">
                    <span class="material-symbols-outlined">save</span>
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>