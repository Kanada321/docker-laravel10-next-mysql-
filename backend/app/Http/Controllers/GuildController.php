<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Guild;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class GuildController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function create(Request $request): JsonResponse
    {
        $request->validate([
            'name'        => 'required|string|unique:guilds,name|max:255',
            'description' => 'nullable|string',
        ]);

        $guild = Guild::create([
            'name'        => $request->name,
            'description' => $request->description,
        ]);

        // ギルドマスターとして登録する
        $user = Auth::user();
        $this->assignGuildMaster($guild);

        return response()->json(['message' => 'Guild created successfully'], 201);
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $guilds = Guild::with('users')->get();
        return response()->json($guilds);
    }

    public function update(Request $request, Guild $guild): JsonResponse
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $guild->update([
            'name'        => $request->name,
            'description' => $request->description,
        ]);

        return response()->json(['message' => 'Guild updated successfully'], 200);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $guild = Guild::with('users')->findOrFail($id);
        return response()->json($guild);
    }

    /**
     * @param Guild $guild
     * @return void
     * @throws \Exception
     */
    private function assignGuildMaster(Guild $guild): void
    {
        $user = Auth::user();
        if ($user) {
            $user->guild_id = $guild->id;
            $user->role_id  = Role::where('name', 'guild_master')->first()->id;
            $user->save();
        } else {
            throw new \Exception('User not authenticated');
        }
    }

    /**
     * @param Guild $guild
     * @return JsonResponse
     */
    public function fetchGuild(Guild $guild): JsonResponse
    {
        $user        = Auth::user();
        $userGuildId = $user->guild_id;
        if ($guild->id !== $userGuildId) {
            return response()->json(['error' => 'Guild not found'], 404);
        }

        return response()->json([
            'parameter'   => $guild->parameter,  // ギルドのパラメータを返す
            'name'        => $guild->name,            // ギルドの名前を返す
            'description' => $guild->description,  // ギルドの説明を返す
            'use_pass'    => $guild->use_pass,
        ], 200);

    }

}
