<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('setWebHook','TelegramController@webHook');
Route::post('488319522:AAG8ymZ9PhAix7FxQ9hGnoaNZZHKRKHLAOk/webhook','TelegramController@getWebHook');
//Route::get('bot/webhook','TelegramController@getWebHook');
//Route::put('bot/webhook','TelegramController@getWebHook');
//Route::patch('bot/webhook','TelegramController@getWebHook');
Route::post('bot/webhook','TelegramController@getWebHook');
//Route::get('getWebHook','TelegramController@getWebHook');