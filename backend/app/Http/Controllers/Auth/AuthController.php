<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // ログイン
    public function login(AuthRequest $request)
    {
        $credentials = $request->only('userId', 'password');

        if (Auth::attempt(['user_identification' => $credentials['userId'], 'password' => $credentials['password']])) {
            $user = Auth::user();
            $user->tokens()->delete();  // 古いトークンを削除

            try {
                $guild = $user->guild;

                if ($guild) {
                    $guildId = $guild->id;
                } else {
                    return response()->json(['error' => 'Guild not found'], 404);
                }

                $token = $user->createToken("login:user{$user->id}")->plainTextToken;

                return response()->json(['guildId' => $guildId], Response::HTTP_OK)
                                 ->cookie('token', $token, 60, '/', null, true, true);  // HTTP Only Cookie
            } catch (\Exception $e) {
                return response()->json(['error' => 'Error fetching guild'], 500);
            }
        }

        return response()->json('Can Not Login.', Response::HTTP_UNAUTHORIZED);
    }

    public function logout(Request $request): JsonResponse
    {
        $token = $request->user()->currentAccessToken();

        if ($token instanceof PersonalAccessToken) {
            $token->delete();
        }

        // セッションとクッキーをクリア
        Auth::guard('web')->logout();
        Session::flush(); //  Redisセッションストレージをクリア
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // クッキーの削除
        return response()->json(['message' => 'Successfully logged out'])
                         ->withCookie(cookie()->forget('token'));
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
