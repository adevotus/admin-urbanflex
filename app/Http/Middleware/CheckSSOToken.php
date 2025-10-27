<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class CheckSSOToken
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
        $token = session('jwt_token');

        if (!$token) {
            return redirect('http://127.0.0.1:8081/login')->with('error', 'Unauthorized: Please login.');
        }

        try {

            $secret = config('app.jwt_secret');

             //dd($secret);
            $decoded = JWT::decode($token, new Key($secret, 'HS256'));

        } catch (\Exception $e) {
            session()->forget(['jwt_token', 'user']);
            return redirect('http://127.0.0.1:8081/login')->with('error', 'Session expired, please login again.');
        }

        // Optionally attach user info to request
        $request->attributes->add(['user' => (array)$decoded]);

        return $next($request);
    }
}
