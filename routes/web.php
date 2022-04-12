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

Route::get('/', [App\Http\Controllers\Models\VinylController::class, 'all']);
Route::get('/vinyl/{id}', [App\Http\Controllers\Models\VinylController::class, 'one']);

Route::get('/redirect', [\App\Http\Controllers\Auth\LoginController::class, 'redirectToProvider']);
Route::get('/callback', [\App\Http\Controllers\Auth\LoginController::class, 'handleProviderCallback']);

Auth::routes();
Route::get('/account', function () {
    return view('account');
});
