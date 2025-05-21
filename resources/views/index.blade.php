@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Docentes</h2>

    <div class="row">
        @forelse($teachers as $teacher)
            <div class="col-sm-3 mb-4">
                <div class="card text-center" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $teacher->nombre }}</h5>

                        <!-- Enlace para editar -->
                        <!--<a href="{{ route('teachers.edit', $teacher) }}" class="btn w-100 mb-2" style="background-color: #6F7271; color: white; border-color: #9D2449;">Ver</a> -->

                        <a href="{{ route('teachers.show', $teacher) }}" class="btn w-100 mb-2" style="background-color: #6F7271; color: white; border-color: #9D2449;">Ver</a>


                        <!-- Formulario para eliminar -->
                        <form action="{{ route('teachers.destroy', $teacher) }}" method="POST" class="d-inline w-100">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn w-100" style="background-color: #9D2449; color: white; border-color: #9D2449;">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center col-12">No se encontraron docentes.</p>
        @endforelse
    </div>
</div>
@endsection



