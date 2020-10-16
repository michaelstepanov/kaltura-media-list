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

Route::get('/', function () {
    return redirect()->route('entries.index');
});

Auth::routes();

Route::middleware('auth.kaltura')->group(function (){
    Route::resource('entries', 'Kaltura\EntryController');
});
