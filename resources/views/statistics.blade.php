@extends('layouts.app')

@section('content')
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
@endsection