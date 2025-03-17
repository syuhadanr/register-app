<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'nik' => 'required|digits:16|unique:users,nik',
            'nama' => 'required|string|uppercase',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'agama' => 'required|string',
            'alamat' => 'required|string',
            'hobi' => 'nullable|array',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validate image file
        ]);

        // Handle file upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('uploads/photos', 'public');
        }

        // Save user to database
        User::create([
            'nik' => $request->nik,
            'nama' => strtoupper($request->nama),
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'hobi' => json_encode($request->hobi), // Convert array to JSON
            'photo' => $photoPath, // Save file path
        ]);

        return redirect()->route('register.form')->with('success', 'Registrasi berhasil!');
    }

}

