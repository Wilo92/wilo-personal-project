<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\ValidationException;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class AuthController extends Controller
{
    use ThrottlesLogins;
    protected $maxAttempts = 3;
    protected $decayMinutes = 5;

    public function username()
    {
        return 'email';
    }
    
    public function showLoginForm()
    {
        return view('auth.login');
    }

    
    public function login(Request $request)
    {

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
           return $this->sendLockoutResponse($request);
        }


        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $this->clearLoginAttempts($request);
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Credenciales correctas. ¡Bienvenido de nuevo!');
        }

        $this->incrementLoginAttempts($request);

        return back()->withErrors([
            'email' => 'La contraseña o correo ingresado no coinciden con una cuenta activa en el sistema.',
        ]);
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
