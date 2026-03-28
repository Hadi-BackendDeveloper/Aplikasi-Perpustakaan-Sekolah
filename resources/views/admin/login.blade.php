<html>
<head>
    <title>Login Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen flex items-center justify-center bg-linear-to-br from-primary via-secondary to-accent1">
<div class="w-full max-w-md p-6">
    <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-xl p-8">
        <h2 class="text-2xl font-bold text-center text-primary mb-6">
            Admin Login
        </h2>

        @if(session('error'))
            <div class="bg-red-500 text-white p-2 mb-4 rounded">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="/admin/login" class="space-y-4">
            @csrf
            <div>
                <label class="text-sm text-gray-600">Email</label>
                <input type="email" name="email" required
                    class="w-full mt-1 p-3 border rounded-lg focus:ring-2 focus:ring-primary outline-none">
            </div>
            <div>
                <label class="text-sm text-gray-600">Password</label>
                <input type="password" name="password" required
                    class="w-full mt-1 p-3 border rounded-lg focus:ring-2 focus:ring-primary outline-none">
            </div>
            <button class="w-full bg-primary hover:bg-secondary text-white p-3 rounded-lg transition">
                Login
            </button>
        </form>
    </div>
    <p class="text-center text-white mt-4 text-sm">
        Perpustakaan SMK Insan Global Jakarta
    </p>
</div>
</body>
</html>