<?php

namespace App\Http\Middleware;

use App\Models\Employee;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthEmployee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(!$request->bearerToken()){
            return response()->json([
                'status' => 'Unauthenticated',
                'message' => 'Missing Token'
            ], 401);
        }

        $employee = Employee::getUser();
        if(!$employee){
            return response()->json([
                'status' => 'Unauthorized',
                'message' => 'Invalid Token'
            ], 401);
        }

        return $next($request);
    }
}
