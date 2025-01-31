<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $emailExists = User::where('email', request('email'))
                        ->exists();

        if (!$emailExists) {
            throw ValidationException::withMessages([
                'email' => 'Er bestaat geen account met dit emailadres.'
            ]);
        }
        
        if (! Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'password' => 'Sorry, het wachtwoord is incorrect.'
            ]);
        }

        request()->session()->regenerate();
        
        return redirect('/');
    }

    public function destroy() {
        
        Auth::logout();

        return redirect('/');
    }
}
