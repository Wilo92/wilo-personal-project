@extends('layouts.app')

@section('title', 'Crear Contacto')

@push('styles')
    <style>
        /* 1. SUAVIZAR BORDES: Aplicar un borde redondeado a campos y botones */
        .form-control,
        .btn {
            border-radius: 0.5rem !important;
        }

        /* 2. CORRECCIÓN CLAVE: Ajustar intl-tel-input para que coincida con form-control-lg */
        .iti {
            width: 100%;
        }

        /* CLAVE: Forzar la altura del contenedor de la bandera para que coincida con Bootstrap (calc(2.5rem + 1px)) */
        .iti__flag-container {
            height: calc(2.5rem + 1px);
            display: flex;
            align-items: center;
            border-top-left-radius: 0.5rem;
            border-bottom-left-radius: 0.5rem;
        }

        /* Asegurar que el input de texto (donde va el número) también tenga la altura correcta */
        .iti .form-control-lg {
            height: calc(2.5rem + 1px);
        }

        /* Ajuste de alineación para la etiqueta, necesario cuando no se usa col-form-label */
        .col-form-label.text-end {
            padding-top: 0;
            padding-bottom: 0;
        }
    </style>
@endpush

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                {{-- MEJORA: Título más grande (h2) y más separado (mb-4) --}}
                <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                    <h2 class="fw-bold text-primary mb-0">Crear Nuevo Contacto</h2>
                    {{-- MEJORA: Botón secundario con estilo discreto --}}
                    <a href="{{ route('contacts.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Volver a la lista
                    </a>
                </div>

                <div class="card shadow-lg border-0">
                    <div class="card-body p-4 p-md-5">

                        <form action="{{ route('contacts.store') }}" method="POST" enctype="multipart/form-data"
                            id="contact-form">

                            @csrf

                            {{-- CAMPO: NOMBRE (Estructura de Dos Columnas) --}}
                            <div class="mb-4 row align-items-center">
                                <div class="col-md-3">
                                    {{-- CLAVE: text-end alinea el texto junto al input --}}
                                    <label for="name" class="col-form-label fw-semibold text-end">Nombre:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="name" id="name" class="form-control form-control-lg"
                                        value="{{ old('name') }}" required placeholder="Ej: Juan perez">
                                </div>
                                @error('name')
                                    <div class="col-md-9 offset-md-3">
                                        <span class="text-danger small mt-1">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            {{-- CAMPO: TELÉFONO (Estructura de Dos Columnas + Fix CSS) --}}
                            <div class="mb-4 row align-items-center">
                                <div class="col-md-3">
                                    <label for="phone" class="col-form-label fw-semibold text-end">Teléfono:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="tel" name="phone" id="phone" class="form-control form-control-lg"
                                        value="{{ old('phone') }}">
                                </div>
                                @error('phone')
                                    <div class="col-md-9 offset-md-3">
                                        <span class="text-danger small mt-1">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            {{-- CAMPO: EMAIL (Estructura de Dos Columnas) --}}
                            <div class="mb-4 row align-items-center">
                                <div class="col-md-3">
                                    <label for="email" class="col-form-label fw-semibold text-end">Email:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="email" name="email" id="email" class="form-control form-control-lg"
                                        value="{{ old('email') }}" placeholder="contacto@email.com">
                                </div>
                                @error('email')
                                    <div class="col-md-9 offset-md-3">
                                        <span class="text-danger small mt-1">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            {{-- CAMPO: FECHA DE CUMPLEAÑOS (Estructura de Dos Columnas) --}}
                            <div class="mb-4 row align-items-center">
                                <div class="col-md-3 d-flex align-items-center">
                                    <label for="birthday" class="col-form-label fw-semibold text-end w-100">Fecha de Cumpleaños:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="date" name="birthday" id="birthday" class="form-control form-control-lg"
                                        value="{{ old('birthday') }}">
                                </div>
                                @error('birthday')
                                    <div class="col-md-9 offset-md-3">
                                        <span class="text-danger small mt-1">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            {{-- 3. SECCIÓN DE FOTO (Vuelve a una columna completa, no hay label/input a los lados) --}}
                            <h5 class="mt-5 mb-3 fw-bold text-secondary">Foto de Perfil (Opcional)</h5>

                            <div class="mb-4">
                                <label for="photo" class="form-label fw-semibold">Subir Foto:</label>
                                <input type="file" class="form-control form-control-lg" id="photo" name="photo"
                                    onchange="previewImage(event)">
                                @error('photo')
                                    <span class="text-danger small mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- 4. CONTENEDOR DE PREVISUALIZACIÓN --}}
                            <div class="mb-5">
                                <img id="image-preview" src="#" alt="Previsualización de foto"
                                    style="max-width: 150px; height: 150px; border: 3px solid #0d6efd; padding: 5px; border-radius: 50%; display: none; object-fit: cover;">
                            </div>

                            {{-- MEJORA: Botón principal con más énfasis --}}
                            <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold shadow-sm">
                                <i class="bi bi-save"></i> Guardar Contacto
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- 5. SCRIPTS NECESARIOS PARA EL TELÉFONO --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.4/build/css/intlTelInput.min.css">
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.4/build/js/intlTelInput.min.js"></script>

@section('scripts')
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();

            reader.onload = function(e) {
                const output = document.getElementById('image-preview');
                output.src = e.target.result;
                output.style.display = 'block'; // Mostrar la imagen de previsualización
            }

            reader.readAsDataURL(file);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const input = document.querySelector("#phone");
            const form = document.getElementById("contact-form");

            const iti = window.intlTelInput(input, {
                utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.4/build/js/utils.js",
                initialCountry: "auto",
                separateDialCode: true,
                geoIpLookup: callback => {
                    fetch('https://ipinfo.io/json')
                        .then(res => res.json())
                        .then(data => callback(data.country))
                        .catch(() => {
                            callback("us");
                        });
                },
            });


            if (form) {
                form.addEventListener('submit', function(e) {
                    const fullNumber = iti.getNumber();
                    const dialCode = iti.getSelectedCountryData().dialCode;

                    if (iti.isValidNumber() && dialCode) {
                        const nationalNumber = fullNumber.replace(`+${dialCode}`, '').trim();
                        const formattedNumber = `(+${dialCode}) ${nationalNumber}`;

                        input.value = formattedNumber;
                    } else {
                        input.value = fullNumber;
                    }
                });
            }

        });
    </script>
@endsection