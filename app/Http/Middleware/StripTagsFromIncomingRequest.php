<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StripTagsFromIncomingRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $input = $request->all();

        array_walk_recursive($input, function (&$value) {
            $value = trim(strip_tags($value));
            $value = preg_replace('/<\?php.*?\?>/', '', $value); // Remove PHP tags
        });

        $request->merge($input);

        return $next($request);
    }
}
