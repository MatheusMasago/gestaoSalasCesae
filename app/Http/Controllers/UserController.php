<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string|required|max:255',
            'email' => 'email|required|unique:users',
            'nif' => 'numeric|digits:9',
            'password' => 'min:6|required',
            'user_type' => 'required|in:' . implode(',', [User::TYPE_ADMIN, User::TYPE_MODERATOR, User::TYPE_FORMADOR]),
        ]);

        $photo = null;
        if ($request->hasFile('photo')) {
            $photo = Storage::putFile('uploadedImages', $request->photo);
        }

        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'nif' => $request->nif,
            'password' => Hash::make($request->password),
            'photo' => $photo,
            'user_type' => $request->user_type
        ]);
        return redirect()->route('login')->with('Usuário criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
