<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isResepsionis
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        // Jika user tidak terautentifikasi, redirect ke login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // dd(session('user_role'));
        
        $userRole = session('user_role');

        if ($userRole == 4) {
            return $next($request);
        }

        return redirect('/')->with('error', 'Akses ditolak. Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}
