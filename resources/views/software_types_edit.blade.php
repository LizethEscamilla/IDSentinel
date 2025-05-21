@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Editar Tipo de Software</h2>

    <form action="{{ route('software-types.update', $softwareType) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Tipo de Software</label>
            <input 
                type="text" 
                name="nombre" 
                id="nombre" 
                value="{{ old('nombre', $softwareType->nombre) }}" 
                class="form-control @error('nombre') is-invalid @enderror" 
                required
            >
            @error('nombre')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn" style="background-color: #9D2449; color: white;">Actualizar Tipo de Software</button>
        <a href="{{ route('software-types.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>

</div>
@endsection  {{-- ¡No olvides esta línea! --}}