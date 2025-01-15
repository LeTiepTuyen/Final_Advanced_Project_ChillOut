<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RestrictExternalRequests
{
    public function handle(Request $request, Closure $next)
    {
        $trustedDomains = ['localhost:3000', 'localhost:8000', 'host.docker.internal:3000'];
        $originHeader = $request->headers->get('origin');

        if ($originHeader) {
            $origin = parse_url($originHeader, PHP_URL_HOST) . ':' . parse_url($originHeader, PHP_URL_PORT);
            if (in_array($origin, $trustedDomains)) {
                return $next($request);
            }
        } else {
            return $next($request);
        }

        if ($request->bearerToken()) {
            return $next($request);
        }

        return response()->json(['message' => 'Unauthorized request.'], 401);
    }
}
