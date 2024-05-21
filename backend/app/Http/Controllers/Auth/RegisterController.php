<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(AuthRequest $request)
    {
        try {
            $credentials = $request->only('userId', 'password');
            $hashedPassword = Hash::make($credentials['password']);
            $user = User::create([
                'user_identification' => $credentials['userId'],
                'password' => $credentials['password'], // アクセサでパスワードをハッシュ化
            ]);

            \Log::debug('登録:'.$credentials['userId'].':'.$credentials['password'].':'.$hashedPassword );

            // 201ステータスコードを使用して、新しいリソースが作成されたことを示す
            return response()->json(['message' => 'User registered successfully'], 201);
        } catch (\Exception $e) {
            \Log::debug($e);
            // サーバーエラーのハンドリング
            return response()->json(['error' => 'User registered successfully'], 500);
        }
    }
}
