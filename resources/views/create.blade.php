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
        top: -30px; /* Subir más el contenido */
    }
</style>

{{-- Contenedor de logos --}}
<div class="logo-header">
    <img src="{{ asset('images/logo1.png') }}" alt="Logo Izquierdo" class="logo-left">
    <img src="{{ asset('images/logo2.png') }}" alt="Logo Derecho" class="logo-right">
</div>

{{-- Contenido principal con desplazamiento hacia arriba --}}
<div class="container content-section">
    <h2 class="mb-4 text-center">Registrar Docente</h2>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">
                    <form method="POST" action="{{ route('teachers.store') }}">
                        @csrf

                        <!-- Campo para el nombre -->
                        <div class="form-group mb-3">
                            <label for="nombre">Nombre del docente</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required>
                        </div>

                        <!-- Campo para el RFID -->
                        <div class="form-group mb-3">
                            <label for="rfid">RFID</label>
                            <input type="text" name="rfid" id="rfid" class="form-control" required>
                        </div>

                        <!-- Selección de materias -->
                        <div class="form-group mb-3">
                            <label for="materias">Seleccionar materias</label>
                            <select name="materias[]" id="materias" class="form-control" multiple>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Selección de grupos -->
                        <div class="form-group mb-3">
                            <label for="grupos">Seleccionar grupos</label>
                            <select name="grupos[]" id="grupos" class="form-control" multiple>
                                @foreach($careerGroups as $group)
                                    <option value="{{ $group->id }}">{{ $group->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Selección de software -->
                        <div class="form-group mb-3">
                            <label for="software">Seleccionar software</label>
                            <select name="software[]" id="software" class="form-control" multiple>
                                @foreach($softwareTypes as $software)
                                    <option value="{{ $software->id }}">{{ $software->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Botón de enviar -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn" style="background-color: #9D2449; color: white;">
                                Registrar Docente
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
