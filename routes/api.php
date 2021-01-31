<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/ping', function(Request $request){
    return ['pong'=>true]; 
});

Route::get('/notes', 'App\Http\Controllers\NoteRouterController@all'); 
Route::get('/note/{id}', 'App\Http\Controllers\NoteRouterController@one');
Route::post('/note', 'App\Http\Controllers\NoteRouterController@new');
Route::put('/note/{id}', 'App\Http\Controllers\NoteRouterController@edit');
Route::delete('/note/{id}', 'App\Http\Controllers\NoteRouterController@delete');
