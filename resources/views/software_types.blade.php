@extends('layouts.app')

@section('content')

{{-- Estilos para los logos en las esquinas superiores --}}
<style>
    .logo-header {
        position: relative;
        height: 100px;
        margin-bottom: 0;
    }

    .logo-left {
        position: absolute;
        top: 10px;
        left: 10px;
        height: 100px;
        padding: 5px;
    }

    .logo-right {
        position: absolute;
        top: 10px;
        right: 10px;
        height: 100px;
        padding: 5px;
    }

    .content-section {
        position: relative;
        top: 30px; /* Bajar más el contenido */
    }
</style>

{{-- Contenedor de logos --}}
<div class="logo-header">
    <img src="{{ asset('images/logo1.png') }}" alt="Logo Izquierdo" class="logo-left">
    <img src="{{ asset('images/logo2.png') }}" alt="Logo Derecho" class="logo-right">
</div>

<div class="container content-section">
<div class="container mt-4">

    <h2 class="mb-4">Gestión de Tipos de Software</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Formulario para crear un nuevo tipo de software --}}
    <div class="card mb-4">
        <div class="card-header">Agregar Nuevo Tipo de Software</div>
        <div class="card-body">
            <form action="{{ route('software-types.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del Tipo de Software</label>
                    <input type="text" name="nombre" id="nombre" 
                           class="form-control @error('nombre') is-invalid @enderror" 
                           value="{{ old('nombre') }}" required>
                    @error('nombre')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn" style="background-color: #9D2449; color: white;">Registrar Tipo</button>
            </form>
        </div>
    </div>

    {{-- Tabla con tipos de software existentes --}}
    <div class="card">
        <div class="card-header">Tipos de Software Registrados</div>
        <div class="card-body p-0">
            <table class="table table-bordered table-striped m-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($softwareTypes as $type)
                        <tr>
                            <td>{{ $type->id }}</td>
                            <td>{{ $type->nombre }}</td>
                            <td class="text-center">

                                {{-- Enlace para ir a la vista de edición --}}
                                <a href="{{ route('software-types.edit', $type->id) }}" class="btn btn-sm" style="background-color: #6F7271; color: white; border-color: #9D2449;">
                                    Editar
                                </a>

                                {{-- Formulario eliminar --}}
                                <form action="{{ route('software-types.destroy', $type) }}" method="POST" class="d-inline" 
                                      onsubmit="return confirm('¿Deseas eliminar este tipo de software?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm" style="background-color: #9D2449; color: white;">Eliminar</button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">No hay tipos de software registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection