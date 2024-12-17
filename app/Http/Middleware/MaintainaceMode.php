<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use App\Models\MaintainanceText;
class MaintainaceMode
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}

