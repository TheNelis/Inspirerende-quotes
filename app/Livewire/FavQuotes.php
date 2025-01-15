<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Quote;
use Livewire\WithPagination;
use App\Models\Name;

class FavQuotes extends Component
{
    use Withpagination;
    public $q;
    public $pagination=20;

    public function render()
    {
        if(!$this->q){
            $quotes = Quote::where('favourite', 1)->latest()->paginate($this->pagination); // wordt where boardCode == {boardCode} && favourite
        }else{
            $quotes = Quote::where('favourite', 1)->where('quote','like','%'.$this->q.'%') 
                            ->latest()->paginate($this->pagination); // wordt where boardCode == {boardCode} && favourite && like zoekresultaat
        }

        $personen = Name::all(); // wordt where boardCode == {boardCode}

        return view('board', [
            'quotes' => $quotes,
            'personen' => $personen
        ]);
    }
}