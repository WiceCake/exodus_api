<?php

namespace App\Http\Middleware;

use App\Models\Applicant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthApplicant
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

        $applicant = Applicant::getUser();
        if(!$applicant){
            return response()->json([
                'status' => 'Unauthorized',
                'message' => 'Invalid Token'
            ], 401);
        }

        return $next($request);
    }
}
