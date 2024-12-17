<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\BlockedIp;
use Illuminate\Http\Request;

class BlockIpMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $ipAddress = $request->ip();
        // Check if the IP address is blocked
        if (BlockedIp::where('ip_address', $ipAddress)->exists()) {
            return response()->view('errors.blocked', [], 403); // You can customize the view and HTTP response code
        }
        return $next($request);
    }
}
