<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\Role;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class RoleMenu
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next, $menu): Response
    {

        if (! Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->getUserRoleName() === 'Owner') {
            return $next($request);
        }

        $myroleId = Auth::user()->getUserRoleid();
        if (! Role::find($myroleId)->hasMenu($menu)) {
            abort(403, 'Acceso no autorizado.', ['Contacta al administrador del sistema.']);
        }

        return $next($request);

    }
}
