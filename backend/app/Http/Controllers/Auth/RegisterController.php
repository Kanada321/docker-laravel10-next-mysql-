<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Guild;
use App\Models\User;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Str;
class RegisterController extends Controller
{
    public function register(AuthRequest $request)
    {
        try {
            $credentials = $request->only('userId', 'password');
            $user        = User::create([
                                            'user_identification' => $credentials['userId'],
                                            'password'            => $credentials['password'], // アクセサでパスワードをハッシュ化
                                        ]);

            // guilを作成する、格納される値はtokenにURLパラメータを格納する
            // 一意なトークンを生成
            do {
                $parameter = Str::random(32);
            } while (Guild::where('parameter', $parameter)->exists());

            // ギルド用トークン（URLパラメータ）を作成
            $guild = Guild::create([
                'user_id' => $user->id,
                'parameter' => $parameter,
            ]);

            if ($guild) {
                Log::info("Guild created: " . $guild->id);
            } else {
                Log::error("Guild creation failed");
            }

            // 201ステータスコードを使用して、新しいリソースが作成されたことを示す
            return response()->json(['message' => 'User registered successfully'], 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            // サーバーエラーのハンドリング
            return response()->json(['error' => 'User registered error'], 500);
        }
    }
}
