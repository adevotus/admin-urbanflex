<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyJWT
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
        $token = $request->bearerToken() ?? session('jwt_token');

        if (!$token) {
            return response()->json(['status' => 401, 'message' => 'Token not provided']);
        }

        try {
            $decoded = (array) JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
            $request->attributes->add(['user' => $decoded]);
        } catch (\Exception $e) {
            return response()->json(['status' => 401, 'message' => 'Invalid or expired token']);
        }

        return $next($request);
    }
}
