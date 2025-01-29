<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\BoardInvite;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BoardInviteController extends Controller
{
    public function getOrCreateInvite(Board $board)
    {
        // Check of de huidige gebruiker de eigenaar is
        if ($board->user_id !== auth()->user()->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $invite = BoardInvite::firstOrCreate(
            ['board_id' => $board->id],
            ['token' => Str::random(32)]
        );

        return response()->json([
            'invite_link' => route('board.invite', ['token' => $invite->token])
        ]);
    }

    public function processInvite($token)
    {
        $invite = BoardInvite::where('token', $token)->firstOrFail();
        $user = auth()->user();
        
        // Check of de gebruiker al toegang heeft
        $alreadyHasAccess = DB::table('board_user')
            ->where('board_id', $invite->board_id)
            ->where('user_id', $user->id)
            ->exists();
            
        if (!$alreadyHasAccess) {
            DB::table('board_user')->insert([
                'board_id' => $invite->board_id,
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        return redirect('/')->with('success', 'Je bent toegevoegd aan het board!');
    }
}