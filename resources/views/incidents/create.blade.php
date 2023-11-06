@extends('layouts.base')

@section('title', 'Gestion de Incidencias')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-3 text-start">Gestion de Incidencias</h1>
                <a href="{{ route('incidencias.index') }}" class="btn btn-danger text-end">Regresar</a>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Registrar nueva Incidentes</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('incidencias.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="employee_id" class="form-label">Empleado</label>
                                    <input type="text" class="form-control" id="employee_id" name="employee_id">
                                    <button class="btn btn-primary mt-2" type="button" id="verEmpleados">Ver Lista de Empleados</button>
                                </div>

                                <div class="mb-3">
                                    <label for="item_id" class="form-label">Item</label>
                                    <input type="text" class="form-control" id="item_id" name="item_id">
                                    <button class="btn btn-primary mt-2" type="button"  id="verItems">Ver Lista de Items</button>
                                </div>


                                <div class="mb-3">
                                    <label for="description" class="form-label">Descripción</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="incident_date" class="form-label">Fecha de Incidente</label>
                                    <input type="datetime-local" class="form-control" id="incident_date"
                                        name="incident_date">
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Estado</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="Pendiente">Pendiente</option>
                                        <option value="Revisado">Revisado</option>
                                        <option value="Anulado">Anulado</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Crear Incidencia</button>
                            </form>


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
    <script>
        const url_empleados = '{!! route('employees.datatables') !!}';
        const url_items = '{!! route('items.datatables') !!}';
        const url_store = '{!! route('incidents.datatables') !!}';
    </script>
    <script src="{{ asset('js/create_incidencias.js') }}"></script>

@endsection
