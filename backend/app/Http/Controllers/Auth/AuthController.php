<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // ログイン
    public function login(AuthRequest $request)
    {
        $credentials = $request->only('userId', 'password');
        \Log::debug('ログイン試行:', $credentials);
        if (Auth::attempt(['user_identification' => $credentials['userId'], 'password' => $credentials['password']])) {
            \Log::debug('ログイン成功');
            $user = Auth::user();
            $user->tokens()->delete();
            $token = $user->createToken("login:user{$user->id}")->plainTextToken;

            return response()->json(['token' => $token], Response::HTTP_OK);
        }
        return response()->json('Can Not Login.', Response::HTTP_UNAUTHORIZED);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Logged out']);
    }

    /**
     * ユーザー情報を取得する
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser(Request $request)
    {
        $user = Auth::user();
        return response()->json($user);
    }
}
