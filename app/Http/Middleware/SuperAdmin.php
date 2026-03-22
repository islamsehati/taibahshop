<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SuperAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (
            !$user ||
            !$user->is_admin ||
            $user->level !== 'Super Admin'
        ) {
            abort(403, 'Tidak memiliki akses.');
        }

        return $next($request);
    }
}
