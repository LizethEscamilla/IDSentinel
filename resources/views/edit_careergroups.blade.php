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

    <h2 class="mb-4">Editar Grupo/Carrera</h2>

    <form action="{{ route('careergroups.update', $careergroup) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Grupo/Carrera</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $careergroup->nombre) }}" class="form-control @error('nombre') is-invalid @enderror" required>
            @error('nombre')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn" style="background-color: #9D2449; color: white;">Actualizar Grupo/Carrera</button>
        <a href="{{ route('careergroups.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>

</div>
@endsection



