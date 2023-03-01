<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sample', [\App\Http\Controllers\Sample\IndexController::class, 'show']);

Route::get('/sample/{id}', [\App\Http\Controllers\Sample\IndexController::class, 'showId']);

Route::get('/tweet',\App\Http\Controllers\Tweet\IndexController::class)
->name('tweet.index');

Route::post('/tweet/create', \App\Http\Controllers\Tweet\CreateController::class)
->name('tweet.create');

// tweetIdは整数値だけを受け付ける
// RouteServiceProvider.phpにて設定する
Route::get('/tweet/{tweetId}', \App\Http\Controllers\Tweet\Update\IndexController::class)
->name('tweet.update.index');

Route::put('/tweet/{tweetId}', \App\Http\Controllers\Tweet\Update\PutController::class)
->name('tweet.update.put');

Route::delete('/tweet/delete/{tweetId}', \App\Http\Controllers\Tweet\DeleteController::class)
->name('tweet.delete');