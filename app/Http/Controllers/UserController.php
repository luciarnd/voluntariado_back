<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request) {
        $this->validate($request, [
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $input = $request->all();

        $user = User::create([
            'nombre' => $input['nombre'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        return $user;
    }

    public function show(Request $request) {
        return User::where('email', $request->email)->get();
    }

}
