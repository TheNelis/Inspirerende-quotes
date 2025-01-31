<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\BoardUser;
use Illuminate\Support\Str;
use Storage;

class BoardController extends Controller
{

    public function showBoards()
    {
        $user = auth()->user();

        if (!$user) {
            $boards = [];
            
        } else {
            $userId = $user->id;
            $boards = $user->boards()
                ->withCount('users')
                ->withCount('quotes')
                ->orderBy('board_user.pinned', 'desc') // Sorteer op 'pinned' in de pivot table
                ->get();
        }

        return view('board.boards', [
            'boards' => $boards
        ]);
    }

    public function showLeden($boardId)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect('login');
        }

        $userId = $user->id;

        // Check access to board
        $hasAccess = BoardUser::where('board_id', $boardId)
                    ->where('user_id', $userId)
                    ->exists();

        if (!$hasAccess) {
            return redirect('no-access');
        }

        $boards = Board::withCount('users')
            ->withCount('quotes')
            ->whereHas('users', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->orderBy('pinned','desc')
            ->get();
        $currentBoard = Board::find($boardId);
        $owner = Board::find($boardId)->owner;
        $leden = BoardUser::with('user')
            ->where('board_id', $boardId)
            ->whereNotIn('user_id', [$owner->id])
            ->get();


        return view('board.leden', [
            'boards' => $boards,
            'currentBoard' => $currentBoard,
            'leden' => $leden,
            'owner' => $owner,
            'inviteLink' => route('board.invite', ['token' => $currentBoard->token])
        ]);
    }

    public function showBewerk($boardId)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect('login');
        }

        $userId = $user->id;

        // Check access to board
        $boardOwner = Board::find($boardId);

        if (!$boardOwner->user_id === $userId) {
            return redirect('no-access');
        }

        $boards = Board::withCount('users')
            ->withCount('quotes')
            ->whereHas('users', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->orderBy('pinned','desc')
            ->get();
        $currentBoard = Board::find($boardId);

        return view('board.bewerk', [
            'boards' => $boards,
            'currentBoard' => $currentBoard,
            'inviteLink' => route('board.invite', ['token' => $currentBoard->token])
        ]);
    }

    public function processInvite($token)
    {
        $inviteExists = Board::where('token', $token)
                        ->exists();

        if (!$inviteExists) {
            return redirect('/')->withErrors(['message' => 'De invite bestaat niet of is niet langer geldig.']);
        }

        $board = Board::where('token', $token)->firstOrFail();
        $user = auth()->user();
        
        // Check of de gebruiker al toegang heeft
        $alreadyHasAccess = BoardUser::where('board_id', $board->id)
            ->where('user_id', $user->id)
            ->exists();
            
        if (!$alreadyHasAccess) {
            BoardUser::insert([
                'board_id' => $board->id,
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return redirect('/')->with('success', 'Je bent toegevoegd aan het board!');

        } else {

            return redirect('/')->withErrors(['message' => 'Je bent al lid van dit board.']);
        }
    }

    public function changeInvite($boardId)
    {
        $board = Board::find($boardId);

        if ($board->user_id != auth()->user()->id) {
            return redirect('/')->withErrors(['message' => 'Alleen de owner kan de uitnodigingslink aanpassen.']);
        }

        $board->update([
            'token' => Str::random(32)
        ]);

        return redirect("/board=$boardId/leden");
    }

    public function addBoard()
    {

        $userId = auth()->user()->id;

        request()->validate([
            'title' => ['required', 'max:11'],
            'image' => ['file', 'mimes:jpg,jpeg,png', 'max:2048']
        ]);

        if (!request()->image) {
            $imagePath = 'boards/default-banner.png';
        } else {
            $imagePath = request()->file('image')->store('boards', 'public');
        }
    
        $board = Board::create([
            'title' => request()->title,
            'image' => $imagePath,
            'user_id' => $userId,
            'token' => Str::random(32)
        ]);
        $lastBoardId = $board->id;

        BoardUser::create([
            'board_id' => $lastBoardId,
            'user_id' => $userId,
            'pinned' => false,
        ]);
    
        return redirect("/");
    }

    public function bewerkBoard($boardId)
    {
        $board = Board::findOrFail($boardId);

        request()->validate([
            'title' => ['required', 'max:11'],
            'image' => ['file', 'mimes:jpg,jpeg,png', 'max:2048']
        ]);

        if ($board->user_id != auth()->user()->id) {
            return redirect('/')->withErrors(['message' => 'Alleen de owner kan dit board aanpassen.']);
        }

        if (request()->hasFile('image')) {
            // Verwijder de oude afbeelding (indien aanwezig en geen default)
            if ($board->image && $board->image !== 'boards/default-banner.png') {
                Storage::disk('public')->delete($board->image);
            }

            $imagePath = request()->file('image')->store('boards', 'public');
        } else {
            $imagePath = $board->image;
        }

        $board->update([
            'title' => request('title'),
            'image' => $imagePath,
        ]);

        return redirect("/");
    }

    public function pinBoard()
    {
        $board = BoardUser::where('board_id', request('id'))
                    ->where('user_id', auth()->user()->id);

        if (request('isPinned') == true) {
            $board->update([
                'pinned' => false
            ]);
        } else {
            $board->update([
                'pinned' => true
            ]);
        }

        return redirect("/");
    }

    public function leaveBoard() {
        
        BoardUser::where('board_id', request('id'))
        ->where('user_id', auth()->user()->id)
        ->delete();

        return redirect("/");
    }

    public function deleteBoard()
    {
        $board = Board::findOrFail(request('id'));

        if ($board->user_id != auth()->user()->id) {
            return redirect('no-access');
        }

        // Verwijder de afbeelding voordat het board wordt verwijderd
        if ($board->image && $board->image !== 'boards/default-banner.png') {
            Storage::disk('public')->delete($board->image);
        }

        $board->delete();

        return redirect("/");
    }

    public function removeLid($boardId) {

        $board = Board::find($boardId);

        if ($board->user_id != auth()->user()->id) {
            return redirect('no-access');
        }

        BoardUser::where('board_id', $boardId)
        ->where('user_id', request('userId'))
        ->delete();

        return redirect("/board=$boardId/leden");
    }
}