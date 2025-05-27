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
        top: -30px; /* Subir todo el contenido */
    }
</style>

{{-- Contenedor de logos --}}
<div class="logo-header">
    <img src="{{ asset('images/logo1.png') }}" alt="Logo Izquierdo" class="logo-left">
    <img src="{{ asset('images/logo2.png') }}" alt="Logo Derecho" class="logo-right">
</div>

{{-- Contenido principal --}}
<div class="container content-section">
    <h2 class="mb-4 text-center">Docentes</h2>

    <div class="row">
        @forelse($teachers as $teacher)
            <div class="col-sm-3 mb-4">
                <div class="card text-center" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $teacher->nombre }}</h5>

                        {{-- Enlace para ver --}}
                        <a href="{{ route('teachers.show', $teacher) }}" class="btn w-100 mb-2" style="background-color: #6F7271; color: white; border-color: #9D2449;">Ver</a>

                        {{-- Formulario para eliminar --}}
                        <form action="{{ route('teachers.destroy', $teacher) }}" method="POST" class="d-inline w-100">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn w-100" style="background-color: #9D2449; color: white; border-color: #9D2449;">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center col-12">No se encontraron docentes.</p>
        @endforelse
    </div>
</div>

@endsection





