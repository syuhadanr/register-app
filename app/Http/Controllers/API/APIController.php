<?php
namespace App\Http\Controllers\API;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;


class APIController extends Controller
{
    // ✅ GET All Users
    public function apiIndex()
    {
        return response()->json(User::all(), 200);
    }

    // ✅ CREATE User (POST /api/users)
    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|string|size:16',
            'nama' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'agama' => 'required|string',
            'alamat' => 'required|string',
            'hobi' => 'nullable|array',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('uploads/photos', 'public');
        }

        $user = User::create($validated);

        return response()->json($user, 201);
    }

    // ✅ GET Single User (GET /api/users/{id})
    public function apiShow($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user, 200);
    }

    // ✅ UPDATE User (PUT /api/users/{id})
    public function apiUpdate(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validated = $request->validate([
            'nik' => 'required|string|size:16',
            'nama' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'agama' => 'required|string',
            'alamat' => 'required|string',
            'hobi' => 'nullable|array',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $validated['photo'] = $request->file('photo')->store('uploads/photos', 'public');
        }

        $user->update($validated);

        return response()->json($user, 200);
    }

    // ✅ DELETE User (DELETE /api/users/{id})
    public function apiDestroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
