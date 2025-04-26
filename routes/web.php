<?php

use App\Http\Controllers\PhotoController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;



Route::get('/', [PhotoController::class, 'index']);

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);
    
    Route::get('login', [SessionController::class, 'create']);
    Route::post('login', [SessionController::class, 'store']);
});

Route::delete('logout', [SessionController::class, 'destroy'])->middleware('auth');
Route::resource('photos', PhotoController::class);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
