<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create() 
    {
        return view('auth.register');
    }

    public function store() 
    {

        $attributes = request()->validate([
            'name' => ['required', 'max:10'],
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(6), 'confirmed'],
        ]);

        $user = User::create($attributes);

        Auth::login($user);
        
        return redirect('/');
    }
}
