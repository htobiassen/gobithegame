<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\SeasonController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/leaderboard', [ScoreController::class, 'index'])->name('leaderboard');
Route::post('/scores', [ScoreController::class, 'store'])->name('scores.store');
Route::resource('seasons', SeasonController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
