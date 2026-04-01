<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
public function handle(Request $request, Closure $next, $role): Response
{
    if (!$request->user()) {
        return redirect()->route('login');
    }

    $userRole = $request->user()->role;

    // Tambahkan DD ini sementara untuk liat apa yang dibaca Laravel
    // dd("User Login: " . $userRole, "Halaman yang diminta: " . $role);

    if ($userRole === 'super_admin') {
        return $next($request);
    }

    if ($userRole !== $role) {
        abort(403, "Ditolak! Kamu: $userRole | Minta: $role");
    }

    return $next($request);
}
}