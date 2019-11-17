<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;

class GlobalCache
{
    /**
     * Increase the view count on video or update the view date for history.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws Exception
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $response->header('Cache-Control', 'max-age=86400');

        return $response;
    }
}
