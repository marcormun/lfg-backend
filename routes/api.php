<?php

use App\Http\Controllers\AuthController;
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
        Route::get('/parties/game/{id}', [PartyController::class, 'getPartybyGame']);
        Route::post('/parties', [PartyController::class, 'createParty'])->middleware('jwt.auth');
        Route::put('/parties/{id}', [PartyController::class, 'updateParty'])->middleware('jwt.auth');
        Route::delete('/parties/{id}', [PartyController::class, 'deleteParty'])->middleware('jwt.auth');
    }
);