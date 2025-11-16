<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:15'],
            'email' => ['required', 'string', 'email', 'max:40', 'unique:users'],
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(6)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
        ], [
            'email.unique' => 'Esta cuenta de correo electrónico ya está en uso.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres, combinar mayúsculas y minúsculas, e incluir números y un carácter especial.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->intended(route('home'))->with('success', 'Registro exitoso. ¡Bienvenido!');
    }
}
