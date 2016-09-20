<?php

namespace Alustau\API\Middlewares;

use Closure;

class ResponseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $data     = $response->getContent();

        if ($response->headers->get('content-type') == 'application/json' &&
            $response->getStatusCode() === 200)
        {
            return response()->json(
                ['data' => json_decode($data)],
                $response->getStatusCode()
            );
        }

        return $next($request);
    }
}
