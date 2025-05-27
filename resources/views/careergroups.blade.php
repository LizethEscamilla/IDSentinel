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

    <h2 class="mb-4">Gestión de Grupos/Carreras</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Formulario para crear un nuevo grupo/carrera --}}
    <div class="card mb-4">
        <div class="card-header">Agregar Nuevo Grupo/Carrera</div>
        <div class="card-body">
            <form action="{{ route('careergroups.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre de Grupo/Carrera</label>
                    <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" required>
                    @error('nombre')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn" style="background-color: #9D2449; color: white;">Registrar Grupo/Carrera</button>
            </form>
        </div>
    </div>

    {{-- Tabla con grupos/carreras existentes --}}
    <div class="card">
        <div class="card-header">Grupos/Carreras Registrados</div>
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
                    @forelse($careerGroups as $group)
                        <tr>
                            <td>{{ $group->id }}</td>
                            <td>{{ $group->nombre }}</td>
                            <td class="text-center">
                                <a href="{{ route('careergroups.edit', $group) }}" class="btn btn-sm" style="background-color: #6F7271; color: white; border-color: #9D2449;">Editar</a>
                                <form action="{{ route('careergroups.destroy', $group) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Deseas eliminar este grupo/carrera?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm" style="background-color: #9D2449; color: white;">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">No hay grupos/carreras registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
