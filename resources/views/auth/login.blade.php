<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Iniciar sesión</title>

    <style>
        body {
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
            box-shadow: 0 6px 16px rgba(0,123,255,0.25);
        }

        /* Estilos para la caja de errores ubicada debajo de la card */
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

        /* Ajustes responsivos (centrar y espacio) */
        .login-wrapper {
            min-height: 100vh;
        }

        /* 1. NUEVOS ESTILOS PARA EL TOOLTIP (POP-UP) */
        /* Contenedor que permite posicionar el tooltip relativo al input */
        .password-input-wrapper {
            position: relative; 
            z-index: 10;
        }

        /* Estilo y posición del Tooltip */
        .tooltip-security {
            position: absolute; 
            /* Posicionamiento: lo colocamos justo encima del campo de contraseña */
            bottom: 100%; 
            left: 0; 
            margin-bottom: 10px; /* Separación del input */
            
            padding: 10px 15px;
            background-color: #e5f6ff; /* Fondo azul claro, acorde al branding */
            border: 1px solid #007bff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 20; /* Asegura que esté sobre otros elementos */
            width: 100%; /* Ocupa todo el ancho del contenedor */
            max-width: 380px; /* Limita el ancho máximo para evitar desbordamiento */
            font-size: 0.85rem;
            color: #004085;
            transition: opacity 0.3s ease, transform 0.3s ease;
            opacity: 0; /* Oculto por defecto */
            transform: translateY(5px); /* Un poco desplazado hacia abajo */
            pointer-events: none; /* Ignora clics cuando está oculto */
        }
        
        /* Estilo para mostrar el Tooltip */
        .tooltip-security.show-tooltip {
            opacity: 1;
            transform: translateY(0); /* Vuelve a la posición normal (aparece desde abajo) */
            pointer-events: auto;
        }
    </style>
</head>

<body>
    <div class="container login-wrapper d-flex justify-content-center align-items-center flex-column">
        <!-- Card de login -->
        <div class="card shadow-lg p-4 rounded-4" style="width:24rem; background-color: rgba(255,255,255,0.95);">
            <div class="text-center mb-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid" style="max-height: 120px;">
            </div>

            <h3 class="text-center mb-4 fw-bold text-uppercase text-primary">Login</h3>

            <form method="POST" action="{{ route('login.process') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="email">correo</label>
                    <input class="form-control" type="email" id="email" name="email"
                        value="{{ old('email') }}" required autofocus placeholder="ejemplo@email.com">
                </div>

                <!-- 2. CONTENEDOR DE CONTRASEÑA Y TOOLTIP -->
                <div class="mb-3 password-input-wrapper"> 
                    <label class="form-label" for="password">Contraseña</label>
                    
                    <input class="form-control" type="password" id="password" name="password"
                        required autocomplete="current-password" placeholder="Ingresa tu contraseña"
                        
                        {{-- 3. LLAMADAS JAVASCRIPT: Muestra el tooltip al enfocar --}}
                        onfocus="document.getElementById('security-tooltip').classList.add('show-tooltip')"
                        {{-- Oculta el tooltip al desenfocar (o pasar el cursor fuera) --}}
                        onblur="document.getElementById('security-tooltip').classList.remove('show-tooltip')"
                    >
                    
                    <!-- EL TOOLTIP (POP-UP) -->
                    <div id="security-tooltip" class="tooltip-security">
                        <p class="mb-0 fw-bold">Aviso de Bloqueo de Cuenta</p>
                        <hr class="my-1 border-primary opacity-25">
                        <p class="mb-0">Después de 3 intentos fallidos, tu cuenta se bloqueará por 5 minutos por seguridad</p>
                    </div>
                </div>
                <!-- FIN DEL CONTENEDOR DE CONTRASEÑA Y TOOLTIP -->

                <button class="btn btn-primary w-100 fw-semibold py-2" type="submit"
                    style="background:linear-gradient(90deg,#007bff, #00b4d8);border:none;">
                    Entrar
                </button>

                <div class="text-center mt-3">
                    <a href="{{route('register')}}">Registrarse</a>
                </div>
            </form>
        </div>

        <!-- Caja de errores (fuera de la card, centrada) -->
        <div class="mt-3 w-100 d-flex justify-content-center">
            @if ($errors->any())
                <div id="errorBox" class="error-box d-flex gap-3 align-items-start shadow-sm">
                    <div class="icon-area" aria-hidden="true">
                        <!-- Icono SVG -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                            class="bi bi-exclamation-circle-fill" viewBox="0 0 16 16" role="img" aria-label="Error">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM7.002 4a.905.905 0 1 1 1.996 0L9 9a1 1 0 1 1-2 0L7.002 4zm.998 7a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
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
        document.addEventListener('DOMContentLoaded', function () {
            const box = document.getElementById('errorBox');

            if (!box) return;

            
            const hasErrors = box.textContent && box.textContent.trim().length > 0;

            if (hasErrors) {
                
                void box.offsetWidth;
                box.classList.add('show');
            }
        });
    </script>

    <footer class="text-center text-light mt-4 py-3"
        style="background-color: rgba(0, 0, 0, 0.5); position: fixed; bottom: 0; width: 100%;">
        <p class="mb-0" style="font-size: 0.9rem;">© {{ date('Y') }} Wilo Planner — Creado por <strong>Wilmer Restrepo (Wilo)</strong></p>
    </footer>
</body>
</html>