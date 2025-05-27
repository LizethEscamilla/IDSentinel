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

{{-- Contenido principal con desplazamiento hacia arriba --}}
<div class="container content-section mt-4">
    <h2 class="mb-4 text-center">Detalles del Docente</h2>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">

                    <!-- Campo: Nombre -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nombre del docente:</label>
                        <div>{{ $teacher->nombre }}</div>
                    </div>

                    <!-- Campo: RFID -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">RFID:</label>
                        <div>{{ $teacher->rfid }}</div>
                    </div>

                    <!-- Materias asignadas -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Materias asignadas:</label>
                        <ul class="mb-0">
                            @forelse($teacher->subjects as $subject)
                                <li>{{ $subject->nombre }}</li>
                            @empty
                                <li>No tiene materias asignadas.</li>
                            @endforelse
                        </ul>
                    </div>

                    <!-- Grupos asignados -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Grupos asignados:</label>
                        <ul class="mb-0">
                            @forelse($teacher->careerGroups as $group)
                                <li>{{ $group->nombre }}</li>
                            @empty
                                <li>No tiene grupos asignados.</li>
                            @endforelse
                        </ul>
                    </div>

                    <!-- Software asignado -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Software utilizado:</label>
                        <ul class="mb-0">
                            @forelse($teacher->softwareTypes as $software)
                                <li>{{ $software->nombre }}</li>
                            @empty
                                <li>No tiene software asignado.</li>
                            @endforelse
                        </ul>
                    </div>

                    <!-- Acciones -->
                    <div class="mt-4 d-flex justify-content-between">
                        <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn" style="background-color: #6F7271; color: white; border-color: #9D2449;">Editar</a>
                        <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" onsubmit="return confirm('¿Deseas eliminar este docente?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn" style="background-color: #9D2449; color: white;">Eliminar</button>
                        </form>
                        <a href="{{ route('teachers.index') }}" class="btn btn-link">← Volver a la lista</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

