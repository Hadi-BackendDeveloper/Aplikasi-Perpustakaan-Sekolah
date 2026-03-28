<nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <!-- LEFT: LOGO -->
            <a href="{{ session('siswa_id') ? url('/pustaka') : url('/') }}"
                class="flex items-center gap-2 text-sm md:text-base font-bold text-[rgb(61,61,61)] hover:text-[rgb(61,203,108)] transition">
                <span class="material-symbols-outlined">
                    menu_book
                </span>
                {{-- NAMA BERBEDA --}}
                @if(session('siswa_id'))
                    DASHBOARD SISWA
                @else
                    PERPUSTAKAAN SMK INSAN GLOBAL JAKARTA
                @endif
            </a>
            <!-- CENTER -->
            <div class="hidden md:flex items-center gap-6">
                {{-- SEBELUM LOGIN --}}
                @if(!session('siswa_id'))
                    <form method="GET" action="#"
                        class="flex items-center border rounded px-2 py-1">
                        <span class="material-symbols-outlined text-gray-500">
                            search
                        </span>
                        <input type="text" name="search"
                            placeholder="Cari buku..."
                            class="outline-none px-2 py-1 w-64">
                    </form>
                @endif
                {{-- SETELAH LOGIN --}}
                @if(session('siswa_id'))
                    <a href="{{ route('siswa.pustaka') }}"
                        class="flex items-center gap-1 
                        {{ request()->is('pustaka*') ? 'text-[rgb(61,203,108)] font-semibold' : 'text-[rgb(61,61,61)]' }} 
                        hover:text-[rgb(61,203,108)]">
                        
                        <span class="material-symbols-outlined text-sm">menu_book</span>
                        Pustaka
                    </a>
                    <a href="{{ route('siswa.riwayat') }}"
                        class="flex items-center gap-1 
                        {{ request()->is('riwayat*') ? 'text-[rgb(61,203,108)] font-semibold' : 'text-[rgb(61,61,61)]' }} 
                        hover:text-[rgb(61,203,108)]">
                        <span class="material-symbols-outlined text-sm">history</span>
                        Riwayat
                    </a>
                    <a href="{{ route('siswa.profil') }}"
                        class="flex items-center gap-1 
                        {{ request()->is('profil*') ? 'text-[rgb(61,203,108)] font-semibold' : 'text-[rgb(61,61,61)]' }} 
                        hover:text-[rgb(61,203,108)]">
                        <span class="material-symbols-outlined text-sm">person</span>
                        Profil
                    </a>
                @endif
            </div>
            <!-- RIGHT -->
            <div class="flex items-center gap-2">
                {{-- SEBELUM LOGIN --}}
                @if(!session('siswa_id'))
                    <button onclick="openLoginModal()"
                        class="flex items-center gap-1 bg-[rgb(61,203,108)] text-white px-4 py-2 rounded hover:opacity-90 transition cursor-pointer">
                        <span class="material-symbols-outlined">
                            login
                        </span>
                        Login
                    </button>
                @endif
                {{-- SETELAH LOGIN --}}
                @if(session('siswa_id'))
                    <span class="text-sm mr-2 hidden md:block">
                        {{ session('siswa_nama') }}
                    </span>
                    <form action="{{ url('/logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition cursor-pointer">
                            Logout
                        </button>
                    </form>
                @endif
                <!-- MOBILE BUTTON -->
                <button id="menuBtn" class="md:hidden">
                    <span class="material-symbols-outlined">
                        menu
                    </span>
                </button>
            </div>
        </div>
        <!-- MOBILE MENU -->
        <div id="mobileMenu" class="hidden md:hidden pb-4">
            {{-- SEBELUM LOGIN --}}
            @if(!session('siswa_id'))
                <form method="GET" action="#"
                    class="flex items-center border rounded px-2 py-1 mb-3">
                    <span class="material-symbols-outlined text-gray-500">
                        search
                    </span>
                    <input type="text" name="search"
                        placeholder="Cari buku..."
                        class="outline-none px-2 py-1 w-full">
                </form>
            @endif
            {{-- SETELAH LOGIN --}}
            @if(session('siswa_id'))
                <a href="{{ route('siswa.pustaka') }}"
                    class="flex items-center gap-1 
                    {{ request()->is('pustaka*') ? 'text-[rgb(61,203,108)] font-semibold' : 'text-[rgb(61,61,61)]' }} 
                    hover:text-[rgb(61,203,108)]">    
                        Pustaka
                    </a>
                <a href="{{ route('siswa.riwayat') }}"
                    class="flex items-center gap-1 
                    {{ request()->is('riwayat*') ? 'text-[rgb(61,203,108)] font-semibold' : 'text-[rgb(61,61,61)]' }} 
                    hover:text-[rgb(61,203,108)]">
                    Riwayat
                </a>
                <a href="#" class="block py-2 text-[rgb(61,61,61)] hover:text-[rgb(61,203,108)]">
                    Profil
                </a>
            @endif
        </div>
    </div>
</nav>
<!-- SCRIPT -->
<script>
document.getElementById('menuBtn')?.addEventListener('click', function () {
    const menu = document.getElementById('mobileMenu');
    menu.classList.toggle('hidden');
});
</script>