<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\ValidationException;
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

        $emailTaken = User::where('email', request('email'))
                        ->exists();

        $nameTaken = User::where('name', request('name'))
                    ->exists();

        if ($emailTaken) {
            throw ValidationException::withMessages([
                'email' => 'Er is al een account met dit emailadres.'
            ]);
        }

        if ($nameTaken) {
            throw ValidationException::withMessages([
                'name' => 'Sorry, deze gebruikersnaam bestaat al.'
            ]);
        }

        $user = User::create($attributes);

        Auth::login($user);
        
        return redirect('/');
    }

    public function showProfile() 
    {
        $user = auth()->user();

        if (!$user) {
            $boards = [];

            return view('board.boards', [
                'boards' => $boards
            ]);   
        }

        $boards = $user->boards()
            ->withCount('users')
            ->withCount('quotes')
            ->orderBy('board_user.pinned', 'desc') // Sorteer op 'pinned' in de pivot table
            ->get();

        return view('board.profile', [
            'boards' => $boards,
            'user' => $user
        ]);
    }

    public function changeName() 
    {
        $user = auth()->user();

        request()->validate([
            'newname' => ['required', 'max:10']
        ]);

        $account = User::find($user->id);

        if ($account->name === request('newname')) {
            return redirect('/account');
        }

        $nameExists = User::where('name', request('newname'))
                            ->exists();

        if ($nameExists) {
            throw ValidationException::withMessages([
                'name' => 'Sorry, deze gebruikersnaam bestaat al.'
            ]);
        }

        $account->update([
            'name' => request('newname')
        ]);

        return redirect('/account')->with('success', 'Je gebruikersnaam is gewijzigd!');
    }

    public function changePassword() 
    {
        $user = auth()->user();

        request()->validate([
            'password' => ['required', 'current_password'],
            'newpassword' => ['required', Password::min(6)]
        ], [
            'password.current_password' => 'Het huidige wachtwoord is incorrect.',
        ]);

        $account = User::find($user->id);

        if (request('password') === request('newpassword')) {
            throw ValidationException::withMessages([
                'password' => 'Nieuwe wachtwoord mag niet hetzelfde zijn als huidige.'
            ]);
        }

        $account->update([
            'password' => request('newpassword')
        ]);

        return redirect('/account')->with('success', 'Je wachtwoord is gewijzigd!');
    }

    public function deleteAccount()
    {
        $user = auth()->user();

        $user->delete();

        return redirect('/');
    }
}
