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

Auth::routes();

Route::get('/', [App\Http\Controllers\Models\VinylController::class, 'store']);
Route::get('/vinyl/{id}', [App\Http\Controllers\Models\VinylController::class, 'one']);
Route::post('/vinyl/{vinyl_id}/add_comment', [App\Http\Controllers\Models\CommentController::class, 'create']);
Route::delete('/vinyl/comment/{id}', [App\Http\Controllers\Models\CommentController::class, 'delete']);

Route::get('/redirect', [\App\Http\Controllers\Auth\LoginController::class, 'redirectToProvider']);
Route::get('/callback', [\App\Http\Controllers\Auth\LoginController::class, 'handleProviderCallback']);

Route::get('/account', [App\Http\Controllers\Models\UserController::class, 'info']);
Route::post('/user-update/{id}', [\App\Http\Controllers\Models\UserController::class, 'edit']);
