<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', fn() => view('welcome'))->name('home');

Route::group([
    'middleware' => ['auth:sanctum', 'verified'],
], function(){
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {    
        Route::resource('articles', 'User\ArticleController')
            ->except('show');
    });
    
});

Route::resource('articles', 'ArticleController')
    ->only('index', 'show');