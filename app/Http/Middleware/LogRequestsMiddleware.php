<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogRequestsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $logData = [
            'time'        => now()->toDateTimeString(),
            'method'      => $request->method(),
            'url'         => $request->fullUrl(),
            'headers'     => $request->headers->all(),
            'body'        => $request->all(),
            'status_code' => $response->getStatusCode(),
            'ip'          => $request->ip(),
            'user_agent'  => $request->userAgent(),
        ];

        // Ghi log vào file
        Log::channel('request_logs')->info(json_encode($logData));
        return $response;
    }
}
