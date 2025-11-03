@extends('layouts.app')

@section('title', 'Mis Contactos')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">

                {{-- Botón para ir al formulario de CREAR --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="h4">Directorio de Contactos</h1>
                    <a href="{{ route('contacts.create') }}" class="btn btn-warning fw-semibold">
                        + Agregar Nuevo Contacto
                    </a>
                </div>


                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Teléfono</th>
                                    <th>Email</th>
                                    <th>Cumpleaños</th>
                                    <th style="width: 80px;">Foto</th>
                                    <th class="text-end">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($contacts as $contact)
                                    <tr>
                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->phone }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>
                                            @if ($contact->birthday)
                                                {{ \Carbon\Carbon::parse($contact->birthday)->format('d/m/Y') }}
                                            @endif
                                        </td>
                                        {{-- MODIFICACIÓN CLAVE: Celda de la Foto (Clicable) --}}
                                        <td>
                                            @if ($contact->photo)
                                                <img src="{{ asset('storage/' . $contact->photo) }}"
                                                    alt="foto de {{ $contact->name }}"
                                                    style="width:50px; height:50px;
                                                    object-fit:cover; border-radius:50%; cursor: pointer;"
                                                    title="clic para ver foto" {{-- Atributos de Bootstrap para activar el modal --}} data-bs-toggle="modal"
                                                    data-bs-target="#imageModal" {{-- Función JS para pasar la URL de la imagen al modal --}}
                                                    onclick="setImageModalSrc('{{ asset('storage/' . $contact->photo) }}', '{{ $contact->name }}')">
                                            @else
                                                Sin foto
                                            @endif
                                        </td>


                                        <td class="text-end">

                                            <a href="{{ route('contacts.edit', $contact->id) }}"
                                                class="btn btn-sm btn-outline-primary">Editar</a>


                                            <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST"
                                                class="d-inline" {{-- Usamos un modal para confirmar la eliminación --}}
                                                onsubmit="return confirm('¿Estás seguro de eliminar a {{ $contact->name }}?');">

                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm btn-outline-danger">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">
                                            Aún no tienes contactos.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ESTRUCTURA DEL MODAL DE PREVISUALIZACIÓN --}}
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Foto de Contacto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    {{-- Esta imagen será la que se actualice dinámicamente con la URL --}}
                    <img id="modalImage" src="" alt="Foto en previsualización" class="img-fluid rounded shadow"
                        style="max-height: 80vh;">
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- SCRIPT PARA MANEJAR LA LÓGICA DEL MODAL --}}
@section('scripts')
    <script>
        /**
         * Establece la URL de la imagen y el título del modal antes de mostrarlo.
         * @param {string} imageUrl La URL de la imagen del contacto.
         * @param {string} contactName El nombre del contacto para el título.
         */
        function setImageModalSrc(imageUrl, contactName) {
            const modalImage = document.getElementById('modalImage');
            const modalTitle = document.getElementById('imageModalLabel');

            // Asigna la URL de la imagen para que se cargue en el modal
            modalImage.src = imageUrl;

            // Actualiza el título del modal
            modalTitle.textContent = `Foto de ${contactName}`;
        }
    </script>
@endsection
