@extends('layouts.app')

@section('title', 'Editar Contacto')

@push('styles')
    <style>
        /* 1. SUAVIZAR BORDES: Aplicar un borde redondeado a campos y botones */
        .form-control,
        .btn,
        .card {
            border-radius: 0.5rem !important;
        }
        .card {
            border: none; /* Elimina el borde estándar si usas shadow-lg */
        }

        /* 2. CORRECCIÓN CLAVE: Ajustar intl-tel-input para que coincida con form-control-lg */
        .iti {
            width: 100%;
        }

        /* CLAVE: Forzar la altura del contenedor de la bandera para que coincida con Bootstrap */
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
        
        /* Asegurar la alineación vertical de la etiqueta con el input */
        .col-form-label {
            line-height: 1.5;
        }
    </style>
@endpush

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                {{-- ENCABEZADO ESTILIZADO --}}
                <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                    <h2 class="fw-bold text-primary mb-0">Editar Contacto: {{ $contact->name }}</h2>
                    <a href="{{ route('contacts.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Volver a la lista
                    </a>
                </div>

                <div class="card shadow-lg">
                    <div class="card-body p-4 p-md-5">

                        <form action="{{ route('contacts.update', $contact->id) }}" method="POST"
                            enctype="multipart/form-data" id="contact-form">

                            @csrf
                            @method('PUT')

                            {{-- CAMPO: NOMBRE (Estructura de Dos Columnas y form-control-lg) --}}
                            <div class="mb-4 row align-items-center">
                                <div class="col-md-3 d-flex align-items-center"> 
                                    <label for="name" class="col-form-label fw-semibold text-end w-100">Nombre:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="name" id="name" class="form-control form-control-lg"
                                        value="{{ old('name', $contact->name) }}" required>
                                </div>
                                @error('name')
                                    <div class="col-md-9 offset-md-3">
                                        <span class="text-danger small mt-1">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            {{-- CAMPO: TELÉFONO (Estructura de Dos Columnas y form-control-lg) --}}
                            <div class="mb-4 row align-items-center">
                                <div class="col-md-3 d-flex align-items-center">
                                    <label for="phone" class="col-form-label fw-semibold text-end w-100">Teléfono:</label>
                                </div>
                                <div class="col-md-9">
                                    {{-- Se mantiene type="text" para compatibilidad con intl-tel-input --}}
                                    <input type="text" name="phone" id="phone" class="form-control form-control-lg"
                                        value="{{ old('phone', $contact->phone) }}">
                                </div>
                                @error('phone')
                                    <div class="col-md-9 offset-md-3">
                                        <span class="text-danger small mt-1">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            {{-- CAMPO: EMAIL (Estructura de Dos Columnas y form-control-lg) --}}
                            <div class="mb-4 row align-items-center">
                                <div class="col-md-3 d-flex align-items-center">
                                    <label for="email" class="col-form-label fw-semibold text-end w-100">Email:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="email" name="email" id="email" class="form-control form-control-lg"
                                        value="{{ old('email', $contact->email) }}">
                                </div>
                                @error('email')
                                    <div class="col-md-9 offset-md-3">
                                        <span class="text-danger small mt-1">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            {{-- CAMPO: FECHA DE CUMPLEAÑOS (Estructura de Dos Columnas y form-control-lg) --}}
                            <div class="mb-4 row align-items-center">
                                <div class="col-md-3 d-flex align-items-center">
                                    <label for="birthday" class="col-form-label fw-semibold text-end w-100">Fecha de Cumpleaños:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="date" name="birthday" id="birthday" class="form-control form-control-lg"
                                        value="{{ old('birthday', $contact->birthday ?? '') }}">
                                </div>
                                @error('birthday')
                                    <div class="col-md-9 offset-md-3">
                                        <span class="text-danger small mt-1">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>


                            <h5 class="mt-5 mb-3 fw-bold text-secondary">Foto de Perfil</h5>

                            {{-- MOSTRAR FOTO ACTUAL Y CHECKBOX DE ELIMINAR --}}
                            @if ($contact->photo)
                                <div class="mb-3 d-flex align-items-center">
                                    <div
                                        style="width: 150px; height: 150px; overflow: hidden; border-radius: 50%; border: 3px solid #0d6efd; padding: 5px; margin-right: 20px;">
                                        <img src="{{ asset('storage/' . $contact->photo) }}"
                                            alt="Foto actual de {{ $contact->name }}" class="w-100 h-100"
                                            style="object-fit: cover;">
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remove_photo"
                                            id="remove_photo" value="1">
                                        <label class="form-check-label text-danger fw-semibold" for="remove_photo">
                                            Eliminar foto actual
                                        </label>
                                    </div>
                                </div>
                            @endif

                            <div class="mb-4">
                                <label for="photo" class="form-label fw-semibold">Subir/Reemplazar Foto:</label>
                                <input type="file" class="form-control form-control-lg" id="photo" name="photo"
                                    onchange="previewImage(event)">
                                @error('photo')
                                    <span class="text-danger small mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <img id="image-preview" src="#" alt="Previsualización de foto"
                                    style="max-width: 150px; height: 150px; border: 3px solid #0d6efd; padding: 5px; border-radius: 50%; display: none; object-fit: cover;">
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold shadow-sm">
                                <i class="bi bi-save"></i> Guardar Cambios
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- SCRIPTS Y LIBRERÍA DE TELÉFONO --}}
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

                // Opcional: Desmarcar el checkbox de eliminar si el usuario sube una nueva foto
                const removeCheckbox = document.getElementById('remove_photo');
                if (removeCheckbox) {
                    removeCheckbox.checked = false;
                }
            }

            reader.readAsDataURL(file);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const input = document.querySelector("#phone");
            const form = document.getElementById("contact-form");
            const initialPhoneValue = input.value; // Guardar el valor inicial

            // 1. Inicializar la librería
            const iti = window.intlTelInput(input, {
                // ... configuración de geolocalización y utilities
                utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.4/build/js/utils.js",
                separateDialCode: true,
                initialCountry: "auto",
                geoIpLookup: callback => {
                    fetch('https://ipinfo.io/json')
                        .then(res => res.json())
                        .then(data => callback(data.country))
                        .catch(() => {
                            callback("us");
                        });
                },
            });

            // CLAVE: Cargar el valor inicial DE LA BD en el componente intl-tel-input
            // Se asume que el valor de la BD (contact->phone) es el número limpio (+XXNNNNN)
            // o ya está formateado. Si es el número limpio, intlTelInput lo detectará automáticamente.
            if (initialPhoneValue) {
                iti.setNumber(initialPhoneValue);
            }
            
            // 2. Antes de enviar, asegurar que el input tenga el número completo y formateado
            if (form) {
                form.addEventListener('submit', function(e) {
                    const fullNumber = iti.getNumber();
                    const dialCode = iti.getSelectedCountryData().dialCode;

                    // Si es un número válido y tiene código de marcado (dialCode)
                    if (iti.isValidNumber() && dialCode) {
                        // Formateamos como (+XX) NNNNN... (lo que espera el backend para ser limpiado)
                        const nationalNumber = fullNumber.replace(`+${dialCode}`, '').trim();
                        const formattedNumber = `(+${dialCode}) ${nationalNumber}`;
                        input.value = formattedNumber;
                    } else {
                        // Si no es válido o está vacío, enviamos lo que haya
                        input.value = fullNumber;
                    }
                });
            }
        });
    </script>
@endsection