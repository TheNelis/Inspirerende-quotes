<?php

namespace App\Livewire;

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

    public function mount($boardId) 
    {
        $this->boardId = $boardId; 
    }

    public function render()
    {
        
        if(!$this->q){
            $quotes = Quote::where('board_id', $this->boardId)
                ->latest()
                ->paginate($this->pagination);
        }else{
            $quotes = Quote::where('board_id', $this->boardId)
                ->where('quote','like','%'.$this->q.'%')
                ->latest()
                ->paginate($this->pagination);
        }

        $personen = Name::where('board_id', $this->boardId)->get();

        return view('quoteboard', [
            'quotes' => $quotes,
            'personen' => $personen,
            'boardId' => $this->boardId
        ]);
    }
}