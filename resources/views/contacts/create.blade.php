@extends('layouts.app')

@section('title', 'Crear Contacto')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="h4">Crear Nuevo Contacto</h1>
                    <a href="{{ route('contacts.index') }}" class="btn btn-sm btn-outline-secondary">
                        Volver a la lista
                    </a>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">

                        {{-- 1. CLAVE: Se añade enctype="multipart/form-data" para subir archivos --}}
                        <form action="{{ route('contacts.store') }}" method="POST" enctype="multipart/form-data"
                            id="contact-form">

                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre:</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Teléfono:</label>
                                <input type="tel" name="phone" id="phone" class="form-control"
                                    value="{{ old('phone') }}">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- 2. CAMPO: FECHA DE CUMPLEAÑOS --}}
                            <div class="mb-3">
                                <label for="birthday" class="form-label">Fecha de Cumpleaños:</label>
                                <input type="date" name="birthday" id="birthday" class="form-control"
                                    value="{{ old('birthday') }}">
                                @error('birthday')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- 3. SECCIÓN DE FOTO --}}
                            <h5 class="mt-4 mb-3 border-bottom pb-2">Foto de Perfil (Opcional)</h5>

                            <div class="mb-3">
                                <label for="photo" class="form-label">Subir Foto:</label>
                                {{-- onchange activa la previsualización vía JS --}}
                                <input type="file" class="form-control" id="photo" name="photo"
                                    onchange="previewImage(event)">
                                @error('photo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- 4. CONTENEDOR DE PREVISUALIZACIÓN (Inicialmente oculto) --}}
                            <div class="mb-4">
                                <img id="image-preview" src="#" alt="Previsualización de foto"
                                    style="max-width: 150px; height: auto; border: 2px dashed #ccc; padding: 5px; border-radius: 5px; display: none;">
                            </div>

                            <button type="submit" class="btn btn-primary fw-semibold">
                                Guardar Contacto
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    {{-- 5. SCRIPT DE JAVASCRIPT PARA LA PREVISUALIZACIÓN --}}
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

                    if (iti.isValidNumber() && dialCode){
                        const nationalNumber = fullNumber.replace(`+${dialCode}`, '').trim();
                        const formattedNumber = `(+${dialCode}) ${nationalNumber}`;

                        input.value = formattedNumber;
                    }else{
                        input.value = fullNumber;
                    }
                });
            }

        });
    </script>
@endsection
