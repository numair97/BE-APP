<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'image' => 'required|string',
            'document' => 'required|string',
            'subjects' => 'required|array',
           
        ]);

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'image' => $validatedData['image'],
            'document' => $validatedData['document'],
            'subjects' => json_encode($validatedData['subjects']), 
        ]);

        return response()->json(['message' => 'Registration successful']);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return response()->json(['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        return response()->json(['message' => 'Update successful']);
    }
}
