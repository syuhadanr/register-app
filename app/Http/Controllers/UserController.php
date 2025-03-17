<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    // WEB: Show all users (returns HTML)
    public function index(Request $request)
    {
        $users = User::all();

        if ($request->wantsJson()) {
            return response()->json($users);
        }

        return view('users.index', compact('users'));
    }
    public function generatePDF($id)
    {
        $user = User::findOrFail($id);

        $pdf = Pdf::loadView('users.pdf', compact('user'));

        return $pdf->download('user_' . $user->id . '.pdf');
    }
    // API: Show all users (returns JSON)
    public function apiIndex()
    {
        return response()->json(User::all());
    }

    // API: Store a new user
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|size:16|unique:users,nik',
            'nama' => 'required|string|uppercase',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'agama' => 'required|string',
            'alamat' => 'required|string',
            'hobi' => 'nullable|array',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        dd($request->all(), $request->file('photo'));

        // Handle photo upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

        $user = User::create([
            'nik' => $request->nik,
            'nama' => strtoupper($request->nama),
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'hobi' => json_encode($request->hobi),
            'photo' => $photoPath,
        ]);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'User created successfully!', 'user' => $user], 201);
        }

        return redirect()->route('users.index')->with('success', 'User registered successfully!');
    }

    public function edit($id)
    {
        $user = User::find($id);

        if (!$user) {
            return abort(404);
        }

        return view('users.edit', compact('user'));
    }



    // API: Show a single user
    public function show(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return $request->wantsJson()
                ? response()->json(['message' => 'User not found'], 404)
                : abort(404);
        }

        if ($request->wantsJson()) {
            return response()->json($user);
        }

        return view('users.show', compact('user'));
    }


    // API: Update user data
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return abort(404);
        }

        $request->validate([
            'nik' => 'required|string|size:16|unique:users,nik,' . $id,
            'nama' => 'required|string|uppercase',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'agama' => 'required|string',
            'alamat' => 'required|string',
            'hobi' => 'nullable|array',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo) {
                Storage::delete('public/' . $user->photo);
            }

            // Store new photo
            $photoPath = $request->file('photo')->store('photos', 'public');
            $user->photo = $photoPath;
        }

        $user->update([
            'nik' => $request->nik,
            'nama' => strtoupper($request->nama),
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'hobi' => json_encode($request->hobi),
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }



    // API: Delete a user
    public function destroy(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return $request->wantsJson()
                ? response()->json(['message' => 'User not found'], 404)
                : abort(404);
        }

        if ($user->photo) {
            Storage::delete('public/' . $user->photo);
        }

        $user->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'User deleted successfully!']);
        }

        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}
