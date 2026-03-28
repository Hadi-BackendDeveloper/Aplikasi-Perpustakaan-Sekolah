<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthSiswa
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('siswa_id')) {
            return redirect('/');
        }

        return $next($request);
    }
}