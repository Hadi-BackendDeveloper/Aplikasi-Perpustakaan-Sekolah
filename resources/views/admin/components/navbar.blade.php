<nav class="bg-primary text-white shadow">
  <div class="max-w-7xl mx-auto px-4">
    <div class="flex justify-between items-center h-16">
      <!-- LEFT (LOGO) -->
      <a href="{{ url('/admin/dashboard') }}"
        class="font-bold text-sm md:text-lg flex items-center gap-2 hover:text-accent2 transition">
        <span class="material-symbols-outlined">menu_book</span>
        Perpustakaan SMK Insan Global Jakarta
      </a>
      <!-- CENTER DESKTOP -->
      <div class="hidden md:flex space-x-6">
        <!-- MEMBER -->
        <a href="{{ url('/admin/member') }}"
          class="flex items-center gap-1 transition
          {{ request()->is('admin/member*') ? 'text-accent2 font-semibold border-b-2 border-accent2 pb-1' : 'hover:text-accent2' }}">
          <span class="material-symbols-outlined text-[18px]">groups</span>
          Member
        </a>
        <!-- BUKU -->
        <a href="{{ url('admin/buku') }}"
          class="flex items-center gap-1 transition
          {{ request()->is('admin/buku*') ? 'text-accent2 font-semibold border-b-2 border-accent2 pb-1' : 'hover:text-accent2' }}">
          <span class="material-symbols-outlined text-[18px]">menu_book</span>
          Buku
        </a>
        <!-- PEMINJAMAN -->
        <a href="{{ url('admin/peminjaman') }}"
          class="flex items-center gap-1 transition
          {{ request()->is('admin/peminjaman*') ? 'text-accent2 font-semibold border-b-2 border-accent2 pb-1' : 'hover:text-accent2' }}">
          <span class="material-symbols-outlined text-[18px]">assignment</span>
          Peminjaman
        </a>
      </div>
      <!-- RIGHT -->
      <div class="hidden md:block">
        <a href="/admin/logout"
          class="flex items-center gap-1 bg-white text-black px-4 py-2 rounded hover:bg-accent2 transition">
          <span class="material-symbols-outlined text-[18px]">logout</span>
          Logout
        </a>
      </div>
      <!-- MOBILE BUTTON -->
      <button id="menuBtn" class="md:hidden text-white text-2xl">
        <span class="material-symbols-outlined">
          menu
        </span>
      </button>
    </div>
  </div>
  <!-- MOBILE MENU -->
  <div id="mobileMenu" class="hidden md:hidden bg-secondary px-4 pb-4 space-y-2">
    <a href="{{ url('/admin/member') }}"
      class="flex items-center gap-2 py-2 transition
      {{ request()->is('admin/member*') ? 'text-accent2 font-semibold' : '' }}">
      <span class="material-symbols-outlined text-[18px]">groups</span>
      Kelola Data Member
    </a>
    <a href="{{ url('/admin/buku') }}"
      class="flex items-center gap-2 py-2 transition
      {{ request()->is('admin/buku*') ? 'text-accent2 font-semibold' : '' }}">
      <span class="material-symbols-outlined text-[18px]">menu_book</span>
      Kelola Data Buku
    </a>
    <a href="{{ url('admin/peminjaman') }}"
      class="flex items-center gap-2 py-2 transition
      {{ request()->is('admin/peminjaman*') ? 'text-accent2 font-semibold' : '' }}">
      <span class="material-symbols-outlined text-[18px]">assignment</span>
      Riwayat Peminjaman
    </a>
    <a href="/admin/logout"
      class="flex items-center justify-center gap-2 mt-2 bg-accent2 text-black px-3 py-2 rounded">
      <span class="material-symbols-outlined text-[18px]">logout</span>
      Logout
    </a>
  </div>
  <script>
    const btn = document.getElementById('menuBtn');
    const menu = document.getElementById('mobileMenu');
    btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
  </script>
</nav>