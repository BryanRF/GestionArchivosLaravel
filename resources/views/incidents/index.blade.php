@extends('layouts.base')

@section('title', 'Gestion de Incidencias')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-3 text-start">Gestion de Incidencias</h1>
                <a href="{{ route('incidencias.create') }}" class="btn btn-primary text-end">Nueva Incidencia</a>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Listado de Incidentes</h5>
                        </div>
                        <div class="card-body">
                            <table id="incidents-table" class="table">
                                <thead>
                                    <tr>
                                        <th>Fecha Incidencia</th>
                                        <th>Fecha Revision</th>
                                        <th>Detalle Incidente</th>
                                        <th>Prioridad</th>
                                        <th>Estado</th>
                                        <th class=" no-export">Acciones</th>
                                    </tr>
                                </thead>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
    <script>
        const url_incidencias = '{!! route('incidents.datatables') !!}';
        const modulo = 'Incidencias';
    </script>
     <script src="{{ asset('js/review_incident.js') }}"></script>
    <script src="{{ asset('js/incidencias.js') }}"></script>

@endsection
