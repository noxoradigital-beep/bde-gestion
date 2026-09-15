<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// Bloque l'accès à une page si l'utilisateur connecté n'est pas admin (ex: page "Membres BDE").
// Utilisé dans les routes avec ->middleware('admin').
class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Si pas admin -> erreur 403 "accès refusé". Sinon, la requête continue normalement.
        abort_unless($request->user()?->isAdmin(), 403, 'Réservé aux administrateurs BDE.');

        return $next($request);
    }
}
