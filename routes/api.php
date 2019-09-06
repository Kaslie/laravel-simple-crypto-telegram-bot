<?php

use Illuminate\Http\Request;
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
Route::get('initialize','TelegramController@initialize');
Route::get('getInfo','TelegramController@getBotInfo');
Route::get('getUpdates','TelegramController@getUpdates');

Route::get('setWebHook','TelegramController@webHook');
Route::post('488319522:AAG8ymZ9PhAix7FxQ9hGnoaNZZHKRKHLAOk/webhook','TelegramController@getWebHook');
Route::post('bot/webhook','TelegramController@getWebHook');