<?php

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
    public function create(Request $request):JsonResponse
    {
        $request->validate([
            'name' => 'required|string|unique:guilds,name|max:255',
            'description' => 'nullable|string',
        ]);

        $guild = Guild::create([
            'name' => $request->name,
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
    public function index():JsonResponse
    {
        $guilds = Guild::with('users')->get();
        return response()->json($guilds);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id):JsonResponse
    {
        $guild = Guild::with('users')->findOrFail($id);
        return response()->json($guild);
    }

    /**
     * @param Guild $guild
     * @return void
     * @throws \Exception
     */
    private function assignGuildMaster(Guild $guild) :void
    {
        $user = Auth::user();
        if ($user) {
            $user->guild_id = $guild->id;
            $user->role_id = Role::where('name', 'guild_master')->first()->id;
            $user->save();
        } else {
            throw new \Exception('User not authenticated');
        }
    }
}
