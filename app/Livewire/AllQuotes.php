<?php

namespace App\Livewire;

use App\Models\Board;
use Livewire\Component;
use App\Models\Quote;
use Livewire\WithPagination;
use App\Models\Name;

class AllQuotes extends Component
{
    use Withpagination;
    public $q;
    public $pagination=20;
    public $boardId;
    public $userId;

    public function mount($boardId) 
    {
        $this->boardId = $boardId;

        $user = auth()->user();

        if (!$user) {
            return redirect('login');
        }

        $this->userId = $user->id;

        // Check toegang
        $hasAccess = Board::where('id', $this->boardId)
            ->where(function($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->orWhereHas('users', function($query) use ($user) {
                        $query->where('users.id', $user->id);
                    });
            })
            ->exists();

        if (!$hasAccess) {
            return redirect('no-access');
        }
    }

    public function render()
    {
        if(!$this->q){
            $quotes = Quote::where('board_id', $this->boardId)
                ->latest()
                ->paginate($this->pagination);
        }else{
            $quotes = Quote::with('name')
                ->where('board_id', $this->boardId)
                ->where(function($query) {
                    $query->where('quote', 'like', '%'.$this->q.'%')
                          ->orWhereHas('name', function ($nameQuery) {
                              $nameQuery->where('name', 'like', '%'.$this->q.'%');
                          });
                })
                ->latest()
                ->paginate($this->pagination);
        }

        $personen = Name::where('board_id', $this->boardId)->get();
        $boardTitle = Board::find($this->boardId)->title;

        return view('quoteboard', [
            'quotes' => $quotes,
            'personen' => $personen,
            'boardId' => $this->boardId,
            'boardTitle' => $boardTitle,
            'userId' => $this->userId
        ]);
    }
}