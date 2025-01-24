<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Quote;

class QuizController extends Controller
{
    public $boardId;

    public function showQuiz($boardId)
    {
        $this->boardId = $boardId; 
        $user = auth()->user();

        if (!$user) {
            return redirect('login');
        }

        $hasAccess = Board::where('id', $this->boardId)
            ->where(function($query) use ($user) {
                $query->where('user_id', $user->id)  // Board eigenaar
                    ->orWhereHas('users', function($query) use ($user) {
                        $query->where('users.id', $user->id);  // Gedeelde gebruiker
                    });
            })
            ->exists();

        if (!$hasAccess) {
            return redirect('no-access');
        }

        $quotes = Quote::where('board_id', $this->boardId)
        ->inRandomOrder()->get();
        $boardTitle = Board::find($this->boardId)->title;

        return view('quizmode', [
            'quotes' => $quotes,
            'boardId' => $this->boardId,
            'boardTitle' => $boardTitle
        ]);
    }
}