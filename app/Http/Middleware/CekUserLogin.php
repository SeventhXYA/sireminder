<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekUserLogin
{
    //cek apakah user sudah login atau belum, jika belum login akan dipaksa menuju halaman login
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();
        if (in_array($user->id_role, $roles)) {
            return $next($request);
        }
        return redirect('/login');
    }
}
