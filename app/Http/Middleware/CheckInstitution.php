<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response; // <-- Pastikan ini ada

class CheckInstitution
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userInstitutionSubdomain = Auth::user()->institution->subdomain;
        $routeInstitutionSubdomain = $request->route('institution');

        if ($userInstitutionSubdomain !== $routeInstitutionSubdomain) {
            // Jika subdomain pengguna tidak cocok dengan subdomain rute, larang akses.
            abort(403, 'AKSES DITOLAK. Anda tidak memiliki izin untuk mengakses institusi ini.');
        }

        return $next($request);
    }
}