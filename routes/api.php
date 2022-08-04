<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PartyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/', function () {
    return 'Welcome to my api';
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(
    ['middleware' => 'jwt.auth'],
    function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);
    }
);
Route::group(
    [],
    function() {
        Route::get('/parties', [PartyController::class, 'getAllParties']);
        Route::get('/parties/{id}', [PartyController::class, 'getPartybyId']);
        Route::get('/parties/game/{id}', [PartyController::class, 'getPartybyGameId']);
        Route::post('/parties', [PartyController::class, 'createParty'])->middleware('jwt.auth');
        Route::put('/parties/{id}', [PartyController::class, 'updateParty'])->middleware('jwt.auth');
        Route::delete('/parties/{id}', [PartyController::class, 'deleteParty'])->middleware('jwt.auth');
    }
);

Route::group(
    [],
    function() {
        Route::get('/games', [GameController::class, 'getAllGames']);
        Route::get('/games/{id}', [GameController::class, 'getGamebyId']);
        Route::post('/games', [GameController::class, 'createGame'])->middleware('jwt.auth');
        Route::put('/games/{id}', [GameController::class, 'updateGame'])->middleware('jwt.auth');
        Route::delete('/games/{id}', [GameController::class, 'deleteGame'])->middleware('jwt.auth');
    }
);

Route::group(
    [],
    function(){
        Route::get('messages', [MessageController::class, 'getAllMessages']);
        Route::get('messages/{id}', [MessageController::class, 'getMessagebyId']);
        Route::post('messages', [MessageController::class, 'createMessage'])->middleware('jwt.auth');
        Route::put('messages/{id}', [MessageController::class, 'updateMessage'])->middleware('jwt.auth');
        Route::delete('messages/{id}', [MessageController::class, 'deleteMessage'])->middleware('jwt.auth');
    }
);