<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        if (!$request->user()->role) {
            abort(403, 'Usuario sin rol asignado');
        }

        $roles = explode('|', $role);
        
        foreach ($roles as $requiredRole) {
            if ($this->hasRole($request->user(), $requiredRole)) {
                return $next($request);
            }
        }

        abort(403, 'No tienes permisos para acceder a esta sección');
    }

    private function hasRole($user, $role): bool
    {
        switch ($role) {
            case 'developer':
                return $user->isDeveloper();
            case 'ceo':
                return $user->isCEO();
            case 'director_marca':
                return $user->isDirectorMarca();
            case 'director_creativo':
                return $user->isDirectorCreativo();
            case 'cm':
                return $user->isCM();
            case 'designer':
                return $user->isDesigner();
            case 'cliente':
                return $user->isCliente();
            case 'admin':
                return $user->isDeveloper() || $user->isCEO() || $user->isDirectorMarca() || $user->isDirectorCreativo();
            default:
                return false;
        }
    }
}