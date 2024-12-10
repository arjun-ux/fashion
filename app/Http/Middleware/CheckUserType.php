<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserType
{
    public function handle(Request $request, Closure $next, $usertype)
    {
        if($request->user()->usertype !== $usertype) {
            return redirect('/')->with('error', 'Unauthorized access');
        }
        
        return $next($request);
    }
}