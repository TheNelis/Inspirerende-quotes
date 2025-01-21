<?php

namespace App\Http\Controllers;

use App\Models\Board;

class BoardController extends Controller
{

    public function showBoards()
    {
        $user = auth()->user();

        if (!$user) {
            $boards = 0;
        } else {
            $userId = $user->id;
            $boards = Board::withCount('users')
                ->withCount('quotes')
                ->whereHas('users', function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                })->get();
        }

        return view('boards', [
            'boards' => $boards
        ]);
    }
}