<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Jika yang sudah login adalah 'admin', arahkan ke dasbor admin.
                if ($guard === 'admin') {
                    return redirect()->route('admin.dashboard');
                }

                // Untuk kasus lainnya (user biasa), arahkan ke dasbor user.
                return redirect()->route('index');
            }
        }

        // Jika belum ada yang login, lanjutkan seperti biasa.
        return $next($request);
    }
}