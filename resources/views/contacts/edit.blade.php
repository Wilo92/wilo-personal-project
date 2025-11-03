@extends('layouts.app')

@section('title', 'Editar Contacto')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="h4">Editar Contacto: {{ $contact->name }}</h1>
                    <a href="{{ route('contacts.index') }}" class="btn btn-sm btn-outline-secondary">
                        Volver a la lista
                    </a>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">

                        {{-- 
                       La acción apunta a contacts.update y pasa el ID.
                       El método es POST para simular PUT.
                    --}}
                        <form action="{{ route('contacts.update', $contact->id) }}" method="POST"
                            enctype="multipart/form-data" id="contact-form">

                            @csrf

                            {{-- CLAVE: Simula la petición PUT/PATCH requerida para actualizar --}}
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre:</label>
                                {{-- LÓGICA: Precarga el valor actual --}}
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ old('name', $contact->name) }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Teléfono:</label>
                                <input type="text" name="phone" id="phone" class="form-control"
                                    value="{{ old('phone', $contact->phone) }}">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ old('email', $contact->email) }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="birthday" class="form-label">Fecha de cumpleaños</label>
                                <input type="date" name="birthday" id="birthday" class="form-control"
                                    value="{{ old('birthday', $contact->birthday ?? '') }}">
                                @error('birthday')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>


                            <h5 class="mt-4 mb-3 border-bottom pb-2">Foto de Perfil</h5>


                            @if ($contact->photo)
                                <div class="mb-3 d-flex align-items-center">
                                    <div
                                        style="width: 100px; height: 100px; overflow: hidden; border-radius: 5px; margin-right: 15px;">

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
                            <!-- CAMPO PARA SUBIR/REEMPLAZAR FOTO -->
                            <div class="mb-3">
                                <label for="photo" class="form-label">Subir/Reemplazar Foto:</label>
                                <input type="file" class="form-control" id="photo" name="photo"
                                    onchange="previewImage(event)">
                                @error('photo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- CONTENEDOR DE PREVISUALIZACIÓN -->
                            <div class="mb-4">
                                <img id="image-preview" src="#" alt="Previsualización de foto"
                                    style="max-width: 150px; height: auto; border: 2px dashed #ccc; padding: 5px; border-radius: 5px; display: none;">
                            </div>

                            <button type="submit" class="btn btn-primary fw-semibold">
                                Guardar Cambios
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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
                output.style.display = 'block'; // Hacer visible la imagen de previsualización

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

            // 1. Inicializar la librería con la configuración
            const iti = window.intlTelInput(input, {
                // El valor inicial del input ya está cargado por Laravel Blade (old('phone', $contact->phone))
                utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.4/build/js/utils.js",
                separateDialCode: true,
                initialCountry: "auto",
                geoIpLookup: callback => {
                    // Intento de geolocalización
                    fetch('https://ipinfo.io/json')
                        .then(res => res.json())
                        .then(data => callback(data.country))
                        .catch(() => {
                            callback("us"); // Fallback
                        });
                },
            });

            // 2. Antes de enviar, asegurar que el input tenga el número completo
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
