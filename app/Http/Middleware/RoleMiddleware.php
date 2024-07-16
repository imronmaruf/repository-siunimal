<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect(route('login'));
        }

        $user = Auth::user();

        if (!in_array($user->role, $roles)) {
            return redirect('/dashboard')->with('error', 'Anda tidak memiliki akses untuk halaman ini.');
        }

        if ($user->status !== 'aktif') {
            Auth::logout();
            return redirect(route('login'))->with('error', 'Akun Anda belum aktif atau telah dinonaktifkan.');
        }

        return $next($request);
    }
}
