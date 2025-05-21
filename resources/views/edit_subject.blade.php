@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Editar Materia</h2>

    <form action="{{ route('subjects.update', $subject) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la Materia</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $subject->nombre) }}" class="form-control @error('nombre') is-invalid @enderror" required>
            @error('nombre')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn" style="background-color: #9D2449; color: white;">Actualizar Materia</button>
        <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>

</div>
@endsection