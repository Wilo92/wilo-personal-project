<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    }
    return redirect()->route('login');
});


Route::get('/home',function(){
    return view('home');
})->middleware('auth')->name('home');



Route::get('/login', [AuthController::class, 'showLoginForm'])
->name('login')
->middleware('guest');


Route::post('/login', [AuthController::class, 'login'])->name('login.process');


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
