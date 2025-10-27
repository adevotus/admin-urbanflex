<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\JWTTokenGeneratorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SSOLoginController;
use App\Util\LoggerUtil;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




//Route::get('/sso-login', function (Request $request) {
//    $code = $request->query('code');
//
//    if (!$code) {
//        abort(401, "Missing SSO code");
//    }
//
//    $response = Http::get('http://127.0.0.1:8081/api/v1/sso/exchange', ['code' => $code,]);
//
//    if ($response->failed()) {
//        abort(401, "Invalid or expired SSO code");
//    }
//
//    $data = $response->json();
//    $token = $data['token'];
//    $user  = $data['user']; // full user object
//
//    session(['jwt_token' => $token, 'user' => $user]);
//
//    return redirect('/admin-dashboard');
//
//});
Route::get('/sso-login',[SSOLoginController::class,'ssoLogin'])->name('sso-login');

Route::middleware('check.sso')->group(function () {

    Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin-dashboard');

    Route::post('/logout', function(Request $request) {
        $token = session('jwt_token');

        if ($token) {
            // Call Auth Module API to invalidate token
            $authApi = 'http://127.0.0.1:8081/api/v1/logout';
            Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->post($authApi);

            // Clear local session
            session()->forget(['jwt_token', 'user']);
        }

        return redirect('http://127.0.0.1:8081/login');
    })->name('logout');


    Route::get('admin-profile', [ProfileController::class, 'index'])->name('admin-profile');
});



// for redis
//Route::get('/sso-login', function (Request $request) {
//    $code = $request->query('code');
//
//    if (!$code) {
//        abort(401, "Missing SSO code");
//    }
//
//    $token = Cache::pull('sso_' . $code);
//
//    if (!$token) {
//        abort(401, "Invalid or expired login code");
//    }
//
//    LoggerUtil::info("The token found is $token");
//
//    $secret = config('app.jwt_secret');
//
//    $decoded = JWT::decode($token, new Key($secret, 'HS256'));
//
//   LoggerUtil::info("The token found is $token");
//
//    session(['jwt_token' => $token, 'user' => (array)$decoded]);
//
//    return redirect('/admin-dashboard');
//});

