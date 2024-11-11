<?php

use Illuminate\Support\Facades\Route;
use App\Models\Quote;
use App\Models\Name;
use App\Livewire\AllQuotes;
use App\Livewire\FavQuotes;

Route::get('/', AllQuotes::class);

Route::get('/favorieten', FavQuotes::class);

// Route::get('/', function () {
//     $quotes = Quote::with('name')->latest()->paginate(20);
//     $personen = Name::all();
    
//     return view('home', [
//         'quotes' => $quotes,
//         'personen' => $personen
//     ]);
// });

// Route::get('/favorieten', function () {
//     $quotes = Quote::with('name')->where('favourite', 1)->latest()->paginate(20);
//     $personen = Name::all();
    
//     return view('home', [
//         'quotes' => $quotes,
//         'personen' => $personen
//     ]);
// });

Route::post('/', function () {

    request()->validate([
        'name' => ['required'],
        'date' => ['required'],
        'quote' => ['required']
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