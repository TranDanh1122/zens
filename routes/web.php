<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ZensController;
use App\Http\Controllers\JokeControler;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [ZensController::class, 'index']);
Auth::routes();
Route::get('/profile', [ZensController::class, 'profile'])->name('user.profile')->middleware('auth');
Route::post('/save_joke', [JokeControler::class, 'saveJoke'])->name('saveJoke')->middleware('auth');
Route::post('/vote_joke/{joke}/{state}', [JokeControler::class, 'voteJoke'])->name('voteJoke');
