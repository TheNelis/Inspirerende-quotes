<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Support\Facades\DB;

class BoardController extends Controller
{

    public function showBoards()
    {
        $user = auth()->user();

        if (!$user) {
            $boards = [];
            
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

    public function addBoard()
    {

        $userId = auth()->user()->id;

        request()->validate([
            'title' => ['required', 'max:11'],
            'image' => ['file', 'mimes:jpg,jpeg,png', 'max:5120']
        ]);

        if (!request()->image) {
            $imagePath = 'boards/default-banner.png';
        } else {
            $imagePath = request()->file('image')->store('boards', 'public');
        }
    
        $board = Board::create([
            'title' => request()->title,
            'image' => $imagePath,
            'pinned' => false,
            'user_id' => $userId
        ]);
        $lastBoardId = $board->id;


        DB::table('board_user')->insert(
            array(
                'board_id' => $lastBoardId,
                'user_id' => $userId
            )
        );
    
        return redirect("/");
    }
}