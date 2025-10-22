<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});





Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');


Route::post('/login', [AuthController::class, 'login'])->name('login.process');


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
