<?php

use Illuminate\Support\Facades\Route;
use Modules\Contact\app\Http\Controllers\ContactController;

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

Route::middleware(['auth.admin', 'page.permission'])->group(function() {
    
    Route::get('/', 'ContactController@index')->name('index');
    Route::get('/show/{contact}', 'ContactController@show')->name('show');
    Route::get('/reply/{contact}', 'ContactController@reply')->name('reply');
    
    Route::post('/update/{contact}', 'ContactController@update')->name('update');
    Route::post('/completed/{contact}', 'ContactController@completed')->name('completed');
    Route::delete('/delete/{contact}', 'ContactController@destroy')->name('destroy');
   
    Route::prefix('/replies')->name('replies.')->group(function() {
        Route::get('/', 'ContactReplyController@index')->name('index');
    });
});