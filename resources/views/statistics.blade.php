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
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-6">Estadísticas de Uso de Software</h1>

        <!-- Aquí puedes agregar estadísticas adicionales si lo deseas -->
        <p>Visualiza los registros de acceso y genera un archivo Excel con las estadísticas.</p>

        <div class="mt-4">
            <a href="{{ route('statistics.export') }}" class="btn" style="background-color: #9D2449; color: white;">
                Generar Excel
            </a>
        </div>
    </div>
</div>
@endsection
