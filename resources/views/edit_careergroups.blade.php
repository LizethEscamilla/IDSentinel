@extends('layouts.app')

@section('content')
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



