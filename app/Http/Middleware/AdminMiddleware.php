<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Session;


class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika user tidak terautentikasi (belum login), redirect ke login 
        if (!Auth::check()) {

            return redirect()->route("login");
        }

        // Ambil role dari session yang disimpan saat login 
        $userRole = Session::get('user_role'); 

        // Jika user terautentikasi dan role-nya adalah '1' (Administrator) 
        if ($userRole == 1) {

            return $next($request); 
        } else {
            // Redirect to the correct dashboard based on user role
            switch ($userRole) {
                case 2:
                    return redirect()->route('dokter.dashboard')->with('error', 'Akses ditolak.');
                case 3:
                    return redirect()->route('perawat.dashboard')->with('error', 'Akses ditolak.');
                case 4:
                    return redirect()->route('resepsionis.dashboard')->with('error', 'Akses ditolak.');
                case 5:
                    return redirect()->route('pemilik.dashboard')->with('error', 'Akses ditolak.');
                default:
                    return redirect()->route('login')->with('error', 'Akses ditolak. Silakan login kembali.');
            }
        }
    }
}