<?php
namespace App\Util;

use App\Models\JWTToken;
use Tymon\JWTAuth\JWT;


class JWTValidator {

    public static function validateToken($token)
    {
        if (!$token) {
            return response()->json(['success' => false, 'message' => 'Authorization token not found.'], 401);
        }

        try {
            $storedToken = JWTToken::where('token', $token)->first();

            if (!$storedToken) {
                return response()->json(['success' => false, 'message' => 'Token not recognized or revoked.'], 403);
            }
            $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));

            if ($decoded->iss !== 'urbanflex.org') { return response()->json(['success' => false, 'message' => 'Invalid issuer.'], 403); }

            if (isset($decoded->exp) && $decoded->exp < time()) { return response()->json(['success' => false, 'message' => 'Token has expired.'], 401); }
            return true;

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Token is invalid: ' . $e->getMessage()], 401);
        }
    }
}
