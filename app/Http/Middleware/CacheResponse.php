<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class CacheResponse
{
    /**
     * Cache a response for specific routes
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int  $ttl  Time to live in minutes
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, $ttl = 1440)
    {
        // Don't cache if:
        // 1. Request is from logged-in user
        // 2. Request is not GET
        // 3. Request has query parameters
        if ($request->user() || $request->isMethod('post') || count($request->query()) > 0) {
            return $next($request);
        }

        // Convert $ttl to int if it's a string
        $ttl = (int) $ttl;

        // Create a cache key based on the full URL
        $key = 'page_cache_' . sha1($request->fullUrl());

        // Check if we have cached content
        if (Cache::has($key)) {
            return response(Cache::get($key));
        }

        // Process the request and cache the response
        $response = $next($request);

        // Cache only successful responses
        if ($response->getStatusCode() === 200) {
            $content = $response->getContent();
            Cache::put($key, $content, now()->addMinutes($ttl));
        }

        return $response;
    }
}
