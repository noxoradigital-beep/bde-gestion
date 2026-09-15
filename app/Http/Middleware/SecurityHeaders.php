<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// Ajoute des en-têtes de sécurité à chaque réponse du site (protection contre le
// détournement de clics, l'injection de scripts, etc.). Ne change rien à l'affichage.
class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('Content-Security-Policy-Report-Only',
            "default-src 'self'; " .
            "script-src 'self' 'unsafe-inline' 'unsafe-eval'; " .
            "style-src 'self'; " .
            "font-src 'self'; " .
            "img-src 'self' data:; " .
            "frame-ancestors 'self'"
        );
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        return $response;
    }
}
