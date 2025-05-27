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
        top: -40px; /* Subir más el contenido */
    }
</style>

{{-- Contenedor de logos --}}
<div class="logo-header">
    <img src="{{ asset('images/logo1.png') }}" alt="Logo Izquierdo" class="logo-left">
    <img src="{{ asset('images/logo2.png') }}" alt="Logo Derecho" class="logo-right">
</div>

<div class="container content-section">
<div class="container mt-4">
    <div class="text-center">
        <h2 class="mb-4">Registros de Acceso</h2>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if($accessRecords->isEmpty())
                        <p class="text-center">No hay registros de acceso disponibles.</p>
                    @else
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center">Docente</th>
                                    <th class="text-center">RFID</th>
                                    <th class="text-center">Materia</th>
                                    <th class="text-center">Grupo y Carrera</th>
                                    <th class="text-center">Software Usado</th>
                                    <th class="text-center">Número de Alumnos</th>
                                    <th class="text-center">Fecha</th>
                                    <th class="text-center">Hora de Entrada</th>
                                    <th class="text-center">Hora de Salida</th>
                                    <th class="text-center">Tiempo de Uso</th>
                                    <th class="text-center">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($accessRecords as $record)
                                    <tr>
                                        <td class="text-center">{{ $record->teacher->nombre }}</td> <!-- Nombre del docente -->
                                        <td class="text-center">{{ $record->rfid }}</td>
                                        <td class="text-center">{{ $record->subject->nombre }}</td> <!-- Nombre de la materia -->
                                        <td class="text-center">{{ $record->careerGroup->nombre }}</td> <!-- Grupo y Carrera -->
                                        <td class="text-center">{{ $record->softwareType->nombre }}</td> <!-- Nombre del software -->
                                        <td class="text-center">{{ $record->num_alumnos }}</td>
                                        <td class="text-center">{{ $record->fecha->format('d/m/Y') }}</td>
                                        <td class="text-center">{{ $record->hora_entrada->format('H:i') }}</td>
                                        <td class="text-center">{{ $record->hora_salida ? $record->hora_salida->format('H:i') : 'N/A' }}</td>
                                        <td class="text-center">{{ $record->tiempo_uso ?? 'N/A' }}</td>
                                        <td class="text-center">{{ ucfirst($record->estado) }}</td> <!-- Estado -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection