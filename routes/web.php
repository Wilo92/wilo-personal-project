<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
});



Route::post('/login', function(Request $request) {
 $credentials = $request->validate([
    'email' => ['required', 'email'],
    'password' => ['required'],
 ]);


 if(Auth::attempt($credentials)){
    $request->session()->regenerate();
    return 'Login successful!, '.Auth::user()->name;
 }

 return back()->withErrors([
    'email' => 'The provided credentials do not match our records.',
 ]);

})->name('login.process');
