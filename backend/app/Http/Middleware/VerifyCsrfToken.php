<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Support\Facades\Log;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'api/register', // Exclude register route from CSRF verification
        'api/login', // Exclude login route from CSRF verification
        'api/sanctum/csrf-cookie',
        '/register',
        '/login', // Exclude sanctum CSRF cookie route
    ];

    /**
     * Handle CSRF token verification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     * @throws \Illuminate\Session\TokenMismatchException
     */
    public function handle($request, \Closure $next)
    {
        try {
            // Log incoming request details
            Log::info('CSRF verification started.', [
                'url' => $request->fullUrl(),
                'method' => $request->method(),
                'ip' => $request->ip(),
            ]);

            $response = parent::handle($request, $next);

            // Log success if CSRF verification passes
            Log::info('CSRF verification passed.', [
                'url' => $request->fullUrl(),
                'status' => $response->status(),
            ]);

            return $response;
        } catch (\Illuminate\Session\TokenMismatchException $e) {
            // Log CSRF verification failure
            Log::warning('CSRF verification failed.', [
                'url' => $request->fullUrl(),
                'ip' => $request->ip(),
                'error' => $e->getMessage(),
            ]);



            // Rethrow the exception
            throw $e;
        }
    }
}
