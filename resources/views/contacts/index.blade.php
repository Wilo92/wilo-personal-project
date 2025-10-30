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
                                    <th class="text-end">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($contacts as $contact)
                                    <tr>
                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->phone }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td class="text-end">

                                            <a href="{{ route('contacts.edit', $contact->id) }}"
                                                class="btn btn-sm btn-outline-primary">Editar</a>

                                          
                                            <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('¿Estás seguro de eliminar a {{ $contact->name }}?');">

                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm btn-outline-danger">Eliminar</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">
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
@endsection
