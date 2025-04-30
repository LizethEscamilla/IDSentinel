@extends('layouts.app')

@section('content')
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
                                    @foreach(array_keys($accessRecords->first()->getAttributes()) as $field)
                                        <th class="text-center">{{ ucfirst(str_replace('_', ' ', $field)) }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($accessRecords as $record)
                                    <tr>
                                        @foreach($record->getAttributes() as $value)
                                            <td class="text-center">{{ $value }}</td>
                                        @endforeach
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



