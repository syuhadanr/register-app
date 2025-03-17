<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // 1️⃣ Get all users
    public function index()
    {
        return response()->json(User::all());
    }

    // 2️⃣ Create new user
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|digits:16',
            'nama' => 'required|string|uppercase',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'agama' => 'required|string',
            'alamat' => 'required|string',
            'hobi' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        $user = User::create($validated);
        return response()->json($user, 201);
    }

    // 3️⃣ Get single user
    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json($user);
    }

    // 4️⃣ Update user
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validated = $request->validate([
            'nik' => 'sometimes|digits:16',
            'nama' => 'sometimes|string|uppercase',
            'tempat_lahir' => 'sometimes|string',
            'tanggal_lahir' => 'sometimes|date',
            'jenis_kelamin' => 'sometimes|string',
            'agama' => 'sometimes|string',
            'alamat' => 'sometimes|string',
            'hobi' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        $user->update($validated);
        return response()->json($user);
    }

    // 5️⃣ Delete user
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'User deleted']);
    }
}