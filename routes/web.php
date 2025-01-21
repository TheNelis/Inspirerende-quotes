<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use App\Models\Quote;
use App\Models\Name;
use App\Livewire\AllQuotes;
use App\Livewire\FavQuotes;

Route::get('/', [BoardController::class, 'showBoards']);


Route::get('/board={boardId}', AllQuotes::class);

Route::get('/board={boardId}/favorieten', FavQuotes::class);

Route::get('/board={boardId}/quizmode', function ($boardId) {
    $quotes = Quote::where('board_id', $boardId)
        ->inRandomOrder()->get();

    return view('quizmode', [
        'quotes' => $quotes,
        'boardId' => $boardId
    ]);
});

Route::post('/board', function () {  // wordt '/{boardCode}', check if user has boardCode

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

    return redirect('/board'); // wordt '/{boardCode}'
});

Route::patch('/board', function () { // wordt '/{boardCode}', check if user has boardCode

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

    return redirect('/board'); // wordt '/{boardCode}'
});

Route::delete('/board', function () { // wordt '/{boardCode}', check if user has boardCode

    $quote = Quote::findOrFail(request('id'));
    $quote->delete();
    
    return redirect('/board'); // wordt '/{boardCode}'
});


Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);