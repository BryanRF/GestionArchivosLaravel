@extends('layouts.base')

@section('title', 'Ticket de Incidencia')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-3 text-start">Ticket de Incidencia</h1>
                <a href="{{ route('incidencias.index') }}" class="btn btn-danger text-end">Regresar</a>
            </div>


            <div class="row">
                <div class="col-12">
                    <div class="card">


                        <div class="card-body">
                            <h1>{{ $ticket->title }}</h1>
                            <h4>{{ $ticket->category->name }}</h4>
                            <span class="badge bg-success"><i class="bi bi-tag"></i>{{ $ticket->status }}</span>
                            <p class="text-muted">{{ $ticket->description }}</h2>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Empleado Involucrado:</th>
                                        <td>{{ $ticket->incident[0]->employee->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Item:</th>
                                        <td>{{ $ticket->incident[0]->item->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Fecha del Incidente:</th>
                                        <td>{{ $ticket->incident[0]->incident_date }}</td>
                                    </tr>
                                    <tr>
                                        <th>Codigo Ticket:</th>
                                        <td><button type="button" class="btn-primary btn"
                                                onclick ="copyText(this.innerText)"style="cursor: pointer">{{ $ticket->id }}
                                            </button></td>
                                    </tr>
                                    <tr>
                                        <th>Descripcion de Evidencia:</th>
                                        <td>{{ $ticket->incident[0]->documents[0]->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Archivo de Evidencia:</th>
                                        <td><a class="btn {{ $ticket->incident[0]->documents[0]->color }}"
                                                href="{{ asset('storage/documentos/' . $ticket->incident[0]->documents[0]->file) }}"
                                                download>
                                                <i class="{{ $ticket->incident[0]->documents[0]->icon }}"></i>
                                                {{ $ticket->incident[0]->documents[0]->tipo }}
                                            </a></td>
                                    </tr>
                                </tbody>
                            </table>



                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <script src="{{ asset('js/show_ticket.js') }}"></script>


@endsection
