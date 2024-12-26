<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RestrictExternalRequests
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $trustedDomains = ['localhost:3000', 'localhost:8000'];
        $origin = parse_url($request->headers->get('origin'), PHP_URL_HOST) . ':' . parse_url($request->headers->get('origin'), PHP_URL_PORT);

        // Allow trusted domains
        if (in_array($origin, $trustedDomains)) {
            return $next($request);
        }

        // Check for Bearer token for other domains
        if ($request->bearerToken()) {
            return $next($request);
        }

        return response()->json(['message' => 'Unauthorized request.'], 401);
    }
}
