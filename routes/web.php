<?php

use Illuminate\Support\Facades\Route;
use App\Models\Quote;
use App\Models\Name;
use App\Livewire\AllQuotes;
use App\Livewire\FavQuotes;

Route::get('/', AllQuotes::class);

Route::get('/favorieten', FavQuotes::class);

Route::get('/quizmode', function () {
    $quotes = Quote::inRandomOrder()->get();

    return view('quizmode', [
        'quotes' => $quotes
    ]);
});

Route::post('/', function () {

    request()->validate([
        'newname' => ['max:12'],
        'name' => ['required'],
        'date' => ['required'],
        'quote' => ['required', 'max:150']
    ]);

    if (request('newname')){
        $data = Name::create([
            'name' => request('newname')
        ]);
        $lastId = $data->id;
    } else {
        $name = request('name');
        $lastId = Name::all()->where('name', $name)->first()->id;
    };

    Quote::create([
        'name_id' => $lastId,
        'date' => request('date'),
        'quote' => request('quote'),
        'favourite' => false
    ]);

    return redirect('/');
});

Route::patch('/', function () {

    request()->validate([
        'newname' => ['max:12'],
        'quote' => ['max:150']
    ]);

    $quote = Quote::findOrFail(request('id'));

    if (request('favouriteChanged') == true) {
        $quote->update([
            'favourite' => request('favourite')
        ]);
    }

    $nameId = Name::all()->where('name', request('name'))->first()->id;

    $quote->update([
        'name_id' => $nameId,
        'date' => request('date'),
        'quote' => request('quote'),
        'favourite' => request('favourite')
    ]);

    return redirect('/');
});

Route::delete('/', function () {

    $quote = Quote::findOrFail(request('id'));
    $quote->delete();
    
    return redirect('/');
});