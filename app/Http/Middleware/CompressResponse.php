<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CompressResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        
        // Don't use compression if:
        // 1. It's disabled or not supported
        // 2. Response is already compressed
        // 3. Response is not HTML, CSS, or JavaScript
        if (!extension_loaded('zlib') || 
            ini_get('zlib.output_compression') || 
            $response->headers->has('Content-Encoding') ||
            strpos($response->headers->get('Content-Type'), 'text/html') === false &&
            strpos($response->headers->get('Content-Type'), 'text/css') === false &&
            strpos($response->headers->get('Content-Type'), 'application/javascript') === false
        ) {
            return $response;
        }
        
        // Get the original content
        $content = $response->getContent();
        
        // Only compress if content length is above a threshold (1KB)
        if (strlen($content) < 1024) {
            return $response;
        }
        
        // Compress content and set appropriate headers
        $compressed = gzencode($content, 9);
        
        $response->setContent($compressed);
        $response->headers->add([
            'Content-Encoding' => 'gzip',
            'Content-Length' => strlen($compressed),
            'X-Compression' => 'gzip',
        ]);
        
        return $response;
    }
}
