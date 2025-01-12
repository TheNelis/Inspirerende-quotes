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

    public function render()
    {
        if(!$this->q){
            $quotes = Quote::latest()->paginate($this->pagination);
        }else{
            $quotes = Quote::where('quote','like','%'.$this->q.'%')
                            ->latest()->paginate($this->pagination);
        }

        $personen = Name::all();

        return view('board', [
            'quotes' => $quotes,
            'personen' => $personen
        ]);
    }
}