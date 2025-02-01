<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use App\Models\Quote;
use App\Models\Name;
use App\Livewire\AllQuotes;
use App\Livewire\FavQuotes;

Route::get('/no-access', function() {
    return view('auth.no-access');
});

Route::get('/', [BoardController::class, 'showBoards']);
Route::get('/account', [RegisteredUserController::class, 'showProfile']);
Route::get('/board={boardId}/leden', [BoardController::class, 'showLeden']);
Route::get('/board={boardId}/bewerk', [BoardController::class, 'showBewerk']);

Route::get('/board={boardId}', AllQuotes::class);

Route::get('/board={boardId}/favorieten', FavQuotes::class);

Route::get('/board={boardId}/quizmode', [QuizController::class, 'showQuiz']);


// Quotes ----------------------------------------------------------------------------------------------------
Route::post('/board={boardId}', function ($boardId) {

    request()->validate([
        'newname' => ['max:12'],
        'name' => ['required'],
        'date' => ['required'],
        'quote' => ['required', 'max:150']
    ]);

    if (request('newname')){
        $data = Name::create([
            'name' => request('newname'),
            'board_id' => request('board_id')
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
        'favourite' => false,
        'user_id' => request('user_id'),
        'board_id' => request('board_id'),
    ]);

    return redirect("/board={$boardId}");
});

Route::patch('/board={boardId}', function ($boardId) {

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

    return redirect("/board={$boardId}");
});

Route::delete('/board={boardId}', function ($boardId) {

    $quote = Quote::findOrFail(request('id'));
    $quote->delete();
    
    return redirect("/board={$boardId}");
});



// Boards ----------------------------------------------------------------------------------------------------
Route::post('/', [BoardController::class, 'addBoard']);
Route::patch('/pin', [BoardController::class, 'pinBoard']);
Route::patch('/board={boardId}/bewerk', [BoardController::class, 'bewerkBoard']);
Route::patch('/board={boardId}/changeinvite', [BoardController::class, 'changeInvite']);
Route::delete('/leaveboard', [BoardController::class, 'leaveBoard']);
Route::delete('/deleteboard', [BoardController::class, 'deleteBoard']);
Route::delete('/board={boardId}/leden', [BoardController::class, 'removeLid']);

Route::get('/invite/{token}', [BoardController::class, 'processInvite'])
    ->name('board.invite')
    ->middleware('auth');

// Users ----------------------------------------------------------------------------------------------------
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::patch('/changepassword', [RegisteredUserController::class, 'changePassword']);
Route::patch('/account', [RegisteredUserController::class, 'changeName']);
Route::delete('/account', [RegisteredUserController::class, 'deleteAccount']);


Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

Route::get('/forgot-password', [RegisteredUserController::class, 'forgotPassword']);
Route::post('/forgot-password', [RegisteredUserController::class, 'sendEmail']);
Route::get('/resetpassword/user={name}/id={token}', [RegisteredUserController::class, 'processToken'])
    ->name('resetpassword');
Route::patch('/resetpassword/user={name}/id={token}', [RegisteredUserController::class, 'resetPassword']);

Route::get('test', function() {

    dispatch(function() {
        logger('hello from the queue!');
    });

    return 'Done';
});