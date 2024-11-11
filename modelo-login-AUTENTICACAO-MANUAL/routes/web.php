<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// Grupo guest para ver routes se o usuário não estiver logado
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/loginSubmit', [AuthController::class, 'authenticate'])->name('authenticate');

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store_user'])->name('store_user');

    // New user confirmation
    // Route::get('/new_user_confirmation/{token}', [AuthController::class, 'new_user_confirmation'])->name('new_user_confirmation');
    Route::get('/new_user_confirmation/{token}', [AuthController::class, 'new_user_confirmation'])->name('new_user_confirmation');
    
});

// Grupo auth para ver routes se o usuário estiver logado

Route::middleware('auth')->group(function (){

    Route::get('/', [MainController::class, 'home'])->name('home');
    
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});




