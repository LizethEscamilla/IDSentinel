@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="text-center"> <!-- Contenedor para centrar el título -->
        <h2 class="mb-4">Registrar Docente</h2>
    </div>

    <form method="POST" action="/teachers">
        @csrf
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="nombre">Nombre completo del docente:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn" style="background-color: #9D2449; color: white;">
                                Guardar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection