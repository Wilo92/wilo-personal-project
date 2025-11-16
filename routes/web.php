<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    }
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])
->name('login')
->middleware('guest');


Route::post('/login', [AuthController::class, 'login'])->name('login.process')
->middleware('guest');


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
->name('register')
->middleware('guest');

Route::post('/register', [RegisterController::class, 'register'])->name('register.process')
->middleware('guest');  

Route::middleware(['auth'])->group(function(){
    Route::get('/home', function(){
        return view('home');
    })->name('home');

    Route::resource('contacts',ContactController::class);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});












