<div id="loginModal"
    class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div id="loginContent"
        class="bg-white rounded-xl p-6 w-full max-w-md scale-95 opacity-0 transition duration-300 relative">

        <!-- CLOSE BUTTON -->
        <button onclick="closeLoginModal()"
            class="absolute top-2 right-3 text-xl font-bold">&times;</button>

        <!-- TITLE -->
        <div class="text-center mb-4">
            <div class="flex justify-center mb-2">
                <svg class="w-8 h-8" viewBox="0 0 48 48">
                    <path fill="#EA4335" d="M24 9.5c3.3 0 6.2 1.1 8.5 3.2l6.3-6.3C34.6 2.3 29.7 0 24 0 14.7 0 6.6 5.4 2.7 13.3l7.3 5.7C12.2 13.2 17.6 9.5 24 9.5z"/>
                    <path fill="#34A853" d="M46.1 24.5c0-1.6-.1-2.7-.4-3.9H24v7.4h12.5c-.3 2-1.6 5-4.5 7l6.9 5.3c4-3.7 7.2-9.2 7.2-15.8z"/>
                    <path fill="#4A90E2" d="M10 28.9c-.6-1.7-.9-3.5-.9-5.4s.3-3.7.9-5.4l-7.3-5.7C1 16.3 0 20.1 0 23.5s1 7.2 2.7 10.1l7.3-5.7z"/>
                    <path fill="#FBBC05" d="M24 47c6.5 0 12-2.1 16-5.7l-6.9-5.3c-2 1.4-4.6 2.4-9.1 2.4-6.4 0-11.8-3.7-13.7-9.5l-7.3 5.7C6.6 42.6 14.7 47 24 47z"/>
                </svg>
            </div>
            <h2 class="text-lg font-semibold">Login Siswa</h2>
        </div>

        <!-- NOTIF -->
        @if(session('login_error'))
            <div class="bg-red-100 text-red-700 p-2 mb-3 rounded text-sm">
                {{ session('login_error') }}
            </div>
        @endif

        <!-- FORM -->
        <form action="{{ route('login.siswa') }}" method="POST">
            @csrf

            <input type="text" name="username"
                placeholder="Username"
                class="border p-2 rounded w-full mb-3" required>

            <input type="password" name="password"
                placeholder="Password"
                class="border p-2 rounded w-full mb-3" required>

            <!-- CAPTCHA -->
            <div class="mb-3">
                <div class="flex items-center gap-3">
                    <div class="bg-gray-200 px-3 py-1 rounded font-bold">
                        {{ $captcha ?? session('captcha_login') }}
                    </div>
                    <input type="text" name="captcha_login"
                        placeholder="Captcha"
                        class="border p-2 rounded w-full" required>
                </div>
            </div>
            <button class="w-full bg-[rgb(61,203,108)] text-white py-2 rounded cursor-pointer">
                Login
            </button>
        </form>
        <!-- INFO -->
        <p class="text-sm text-center mt-3 text-gray-600">
            Jika Kamu Belum Memiliki Akun Silahkan Hubungi Guru yang Bertugas
        </p>
    </div>
</div>