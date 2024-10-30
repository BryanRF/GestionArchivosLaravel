
@extends('layouts.base')

@section('title', 'Detalle de Incidencia')

@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-3 text-start">Detalle de Incidencia</h1>
            <a href="{{ route('incidencias.index') }}" class="btn btn-danger text-end">Regresar</a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Empleado:</th>
                                    <td>{{ $incident->employee->name }}</td>
                                </tr>
                                <tr>
                                    <th>Item:</th>
                                    <td>{{ $incident->item->name }}</td>
                                </tr>
                                <tr>
                                    <th>Fecha del Incidente:</th>
                                    <td>{{ $incident->incident_date }}</td>
                                </tr>
                                <tr>
                                    <th>Prioridad:</th>
                                    <td><span class="badge {{ $incident->priority === 'Alto' ? 'bg-danger' : ($incident->priority === 'Medio' ? 'bg-warning' : 'bg-success') }}">
                                        {{ $incident->priority }}
                                    </span></td>
                                </tr>
                                <tr>
                                    <th>Estado:</th>
                                    <td><span class="badge {{ $incident->status === 'Pendiente' ? 'bg-warning' : ($incident->status === 'Revisado' ? 'bg-success' : 'bg-danger') }}">
                                        {{ $incident->status }}
                                    </span></td>
                                </tr>
                                <tr>
                                    <th>Título:</th>
                                    <td>{{ $incident->title }}</td>
                                </tr>
                                <tr>
                                    <th>Descripción:</th>
                                    <td>{{ $incident->description }}</td>
                                </tr>
                                @if($incident->documents->count() > 0)
                                <tr>
                                    <th>Documentos:</th>
                                    <td>
                                        @foreach($incident->documents as $document)
                                        <a href="{{ asset('storage/documentos/' . $document->file) }}"
                                           class="btn {{ $document->color }}"
                                           download>
                                            <i class="{{ $document->icon }}"></i>
                                            {{ $document->name }}
                                        </a>
                                        @endforeach
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
