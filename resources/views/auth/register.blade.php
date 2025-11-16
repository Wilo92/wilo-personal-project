<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Registro - Wilo</title>

    <style>
        body {
            /* Asegúrate de que esta ruta de fondo sea correcta */
            background: url('{{ asset('images/fondoLogin.png') }}') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            margin: 0;
        }

        .btn-primary {
            transition: transform 0.25s ease, box-shadow 0.2s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 123, 255, 0.25);
        }

        /* Estilos de la caja de errores */
        .error-box {
            background: linear-gradient(180deg, #fff6f6, #fff0f0);
            border: 1px solid rgba(220, 53, 69, 0.18);
            color: #b11116;
            padding: 14px 16px;
            border-radius: 12px;
            text-align: left;
            max-width: 520px;
            width: 100%;
            transition: transform 0.18s ease, opacity 0.18s ease;
            opacity: 0;
            transform: translateY(8px);
        }

        .error-box.show {
            opacity: 1;
            transform: translateY(0);
        }

        .error-box .icon-area {
            color: #d63031;
            flex-shrink: 0;
        }

        .error-line {
            margin-bottom: 6px;
            font-weight: 500;
        }

        .login-wrapper {
            min-height: 100vh;
        }

        /* Estilo para los campos de input según tu imagen (fondo amarillo claro) */
        .form-control {
            background-color: #fffacd30;
            /* Amarillo claro muy sutil */
            border-color: #ccc;
        }

        /* Estilo para mensajes de éxito */
        .success-alert {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
            padding: 10px 15px;
            border-radius: 8px;
        }

        /* --- ESTILOS CORREGIDOS Y AJUSTADOS PARA TOOLTIP A LA DERECHA --- */
        .password-input-wrapper {
            /* Contenedor padre de todo el campo de contraseña */
            position: relative;
            z-index: 10;
        }

        .input-tooltip-container {
            /* ESTE ES EL CONTENEDOR FLEXIBLE: INPUT + TOOLTIP */
            display: flex;
            position: relative;
            align-items: flex-start;
            gap: 10px;
        }

        .input-tooltip-container .form-control {
            /* Asegura que el input ocupe el espacio */
            width: 100%;
        }

        .tooltip-security {
            position: absolute;
            top: 0;
            left: 105%;
            /* Posiciona a la derecha del input */

            padding: 10px 15px;
            background-color: rgba(0, 123, 255, 0.95);
            color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
            z-index: 20;
            width: 280px;

            font-size: 0.85rem;

            transition: opacity 0.3s ease, transform 0.3s ease;
            opacity: 0;
            transform: translateX(5px);
            /* Cambié de translateY a translateX para que venga desde la izquierda */
            pointer-events: none;
        }

        .tooltip-security.show-tooltip {
            opacity: 1;
            transform: translateX(0);
            pointer-events: auto;
        }

        @media (max-width: 768px) {
            .input-tooltip-container {
                display: block;
                /* Vuelve a ser block para móvil */
            }

            .tooltip-security {
                display: none;
                /* Ocultamos en móvil */
            }
        }
    </style>
</head>

<body>
    <div class="container login-wrapper d-flex justify-content-center align-items-center flex-column py-5">
        <!-- Card de Registro -->
        <div class="card shadow-lg p-4 rounded-4" style="width:24rem; background-color: rgba(255,255,255,0.95);">
            <div class="text-center mb-3">
                <!-- Por favor, asegúrate de que la ruta de esta imagen sea correcta -->
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid" style="max-height: 100px;">
            </div>

            <h3 class="text-center mb-4 fw-bold text-uppercase text-primary">REGISTRARSE</h3>

            {{-- Muestra mensaje de éxito después de un registro exitoso --}}
            @if (session('success'))
                <div class="success-alert mb-3 text-center">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('register.process') }}" autocomplete="off">
                @csrf

                <!-- Campo: Nombre Completo -->
                <div class="mb-3">
                    <label class="form-label" for="name">Alias</label>
                    <input class="form-control @error('name') is-invalid @enderror" type="text" id="name"
                        name="name" value="{{ old('name') }}" required autofocus placeholder="Your alias"
                        autocomplete="name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Campo: Email -->
                <div class="mb-3">
                    <label class="form-label" for="email">Correo electronico</label>
                    <input class="form-control @error('email') is-invalid @enderror" type="email" id="email"
                        name="email" value="{{ old('email') }}" required placeholder="example@gmail.com"
                        autocomplete="off">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Campo: Contraseña (CORREGIDO con el contenedor 'input-tooltip-container') -->
                <div class="mb-3 password-input-wrapper">
                    <label class="form-label" for="password">Ingresa Contraseña</label>

                    {{-- Este div es crucial para que el input y el tooltip se pongan lado a lado --}}
                    <div class="input-tooltip-container">
                        <input class="form-control @error('password') is-invalid @enderror" type="password"
                            id="password" name="password" required
                            placeholder="La contraseña debe tener al menos 8 caracteres." autocomplete="new-password"
                            onfocus="document.getElementById('security-tooltip-register').classList.add('show-tooltip')"
                            onblur="document.getElementById('security-tooltip-register').classList.remove('show-tooltip')">

                        <!-- EL TOOLTIP (POP-UP) posicionado a la derecha -->
                        <div id="security-tooltip-register" class="tooltip-security">
                            <p class="mb-0 fw-bold">Requisitos contraseña</p>
                            <hr class="my-1 border-white opacity-50"> {{-- Usé 'border-white' para mejor contraste --}}
                            <ul class="list-unstyled mb-0 small">
                                <li>Minimo 6 caracteres de logitud</li>
                                <li>Debe incluir minusculas y mayusculas</li>
                                <li>Contener al menos un numero y un caracter especial</li>
                            </ul>
                        </div>
                    </div>

                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Fin Campo Contraseña -->

                <!-- Campo: Confirmar Contraseña (IMPORTANTE para la regla 'confirmed') -->
                <div class="mb-4">
                    <label class="form-label" for="password_confirmation">Repite Contraseña</label>
                    <input class="form-control" type="password" id="password_confirmation" name="password_confirmation"
                        required placeholder="La contraseña debe coincidir." autocomplete="new-password">
                </div>

                <button class="btn btn-primary w-100 fw-semibold py-2" type="submit"
                    style="background:linear-gradient(90deg,#007bff, #00b4d8);border:none;">
                    REGISTRARSE
                </button>

                <div class="text-center mt-3">
                    <a href="{{ route('login') }}">Ya tienes cuenta? Ingresa</a>
                </div>
            </form>
        </div>

        <!-- Caja de errores (fuera de la card, centrada) -->
        <div class="mt-3 w-100 d-flex justify-content-center">
            @if ($errors->any())
                <div id="errorBox" class="error-box d-flex gap-3 align-items-start shadow-lg">
                    <div class="icon-area" aria-hidden="true">
                        <!-- Icono SVG -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                            class="bi bi-exclamation-circle-fill" viewBox="0 0 16 16" role="img" aria-label="Error">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM7.002 4a.905.905 0 1 1 1.996 0L9 9a1 1 0 1 1-2 0L7.002 4zm.998 7a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                        </svg>
                    </div>

                    <div class="flex-grow-1">
                        <strong class="d-block mb-2">Se detectaron errores:</strong>

                        @foreach ($errors->all() as $error)
                            <div class="error-line">{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @else
                <!-- Caja vacía para mantener el DOM y permitir la animación si aparece luego -->
                <div id="errorBox" class="error-box" style="visibility:hidden;"></div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script para animar la aparición de la caja de errores -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const box = document.getElementById('errorBox');

            if (!box) return;

            // La caja tiene contenido si $errors->any() fue true
            const hasErrors = box.textContent && box.textContent.trim().length > 0;

            if (hasErrors) {
                // Forzar reflow para asegurar la transición
                void box.offsetWidth;
                box.style.visibility = 'visible'; // Hacemos visible la caja con contenido
                box.classList.add('show');
            }
        });
    </script>

    <!-- Pie de página fijo, heredado de tu login -->
    <footer class="text-center text-light mt-4 py-3"
        style="background-color: rgba(0, 0, 0, 0.5); position: fixed; bottom: 0; width: 100%;">
        <p class="mb-0" style="font-size: 0.9rem;">© {{ date('Y') }} Wilo Planner — Created by <strong>Wilmer
                Restrepo (Wilo)</strong></p>
    </footer>
</body>

</html>
