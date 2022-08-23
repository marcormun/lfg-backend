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
    ['middleware' => 'jwt.auth'],
    function() {
        Route::get('/parties', [PartyController::class, 'getAllParties']);
        Route::get('/parties/{id}', [PartyController::class, 'getPartybyId']);
        Route::get('/parties/game/{id}', [PartyController::class, 'getPartybyGameId']);
        Route::post('/parties', [PartyController::class, 'createParty']);
        Route::put('/parties/{id}', [PartyController::class, 'updateParty']);
        Route::delete('/parties/{id}', [PartyController::class, 'deleteParty']);
        Route::post('/joinParty/{id}', [PartyController::class, 'joinParty']);
        Route::delete('/leaveParty/{id}',[PartyController::class, 'leaveParty']);
    }
);

Route::group(
    ['middleware' => 'jwt.auth'],
    function() {
        Route::get('/games', [GameController::class, 'getAllGames']);
        Route::get('/games/{id}', [GameController::class, 'getGamebyId']);
        Route::post('/games', [GameController::class, 'createGame']);
        Route::put('/games/{id}', [GameController::class, 'updateGame']);
        Route::delete('/games/{id}', [GameController::class, 'deleteGame']);
    }
);

Route::group(
    ['middleware' => 'jwt.auth'],
    function(){
        Route::get('messages/{id}', [MessageController::class, 'getMessagebyId']);
        Route::post('messages', [MessageController::class, 'createMessage']);
        Route::put('messages/{id}', [MessageController::class, 'updateMessage']);
        Route::delete('messages/{id}', [MessageController::class, 'deleteMessage']);
    }
);