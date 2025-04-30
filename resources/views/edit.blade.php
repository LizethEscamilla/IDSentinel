@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Editar Docente</h2> <!-- Título centrado -->

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">
                    <!-- Formulario de edición de docente -->
                    <form method="POST" action="{{ route('teachers.update', $teacher->id_docente) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="nombre">Nombre completo del docente:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $teacher->nombre) }}" required>
                            <!-- 'old()' mantiene el valor si el formulario no es válido -->
                        </div>

                        <!-- Mostrar errores si los hay -->
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn" style="background-color: #9D2449; color: white;">
                                Actualizar Docente
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

