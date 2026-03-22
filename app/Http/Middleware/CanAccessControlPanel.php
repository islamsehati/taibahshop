<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanAccessControlPanel
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (
            !$user ||
            !$user->is_admin ||
            is_null($user->level) ||
            $user->level === ''
        ) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        return $next($request);
    }
}
