<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->level !== 'admin') {
            abort(403, 'Halaman ini hanya untuk admin.');
        }

        return $next($request);
    }
}