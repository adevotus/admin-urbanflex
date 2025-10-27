<?php

namespace App\Http\Controllers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\JWTToken;
use Carbon\Carbon;

class JWTTokenGeneratorController extends Controller
{
    public static function generateTokenForUser($user)
    {
        $issuedAt  = time();
        $expiresAt = Carbon::now()->addHours(8)->timestamp; // adjust duration

        $payload = [
            'sub'   => $user->id,
            'email' => $user->email,
            'role'  => $user->role->name ?? 'User',
            'iat'   => $issuedAt,
            'exp'   => $expiresAt,
        ];

        $token = JWT::encode($payload, env('JWT_SECRET'), 'HS256');

        // Store token in DB (optional)
        JWTToken::updateOrCreate(
            ['user_id' => $user->id],
            ['token' => $token, 'expires_at' => date('Y-m-d H:i:s', $expiresAt)]
        );

        return $token;
    }

    public static function invalidateToken($token)
    {
        JWTToken::where('token', $token)->delete();
    }

    public static function decodeToken($token)
    {
        return (array) JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
    }
}
