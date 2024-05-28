<?php
declare(strict_types=1);

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function updateProfile(Request $request)
    {
        $request->validate([
                               'lv'    => 'required|integer|min=1',
                               'class' => 'required|string|max:255',
                           ]);

        $user        = Auth::user();
        $user->lv    = $request->input('lv');
        $user->class = $request->input('class');
        $user->save();

        return response()->json(['message' => 'Profile updated successfully']);
    }
}
