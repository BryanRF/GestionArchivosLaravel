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
                            <form id="form-incidencia" class="row">
                                @csrf
                                <div class="mb-3 col-12 col-md-6">
                                    <label for="employee_id" class="form-label">Empleado</label>
                                    <div class="input-group">
                                        <input type="hidden" class="form-control" value="{{ auth()->user()->id }}"
                                            name="qwec8a4s81c818e51">
                                        <input type="hidden" class="form-control" id="employee_id" name="employee_id"
                                            required>
                                        <input type="text" class="form-control" id="employee_aux" readonly required>
                                        <button class="btn btn-info" type="button" id="verEmpleados">Lista de
                                            Empleados</button>
                                    </div>
                                </div>
                                <div class="mb-3 col-12 col-md-6">
                                    <label for="item_id" class="form-label">Item</label>
                                    <div class="input-group">
                                        <input type="hidden" class="form-control" id="item_id" name="item_id" required>
                                        <input type="text" class="form-control" id="item_aux" readonly required>
                                        <button class="btn btn-info" type="button" id="verItems">Lista de
                                            Items</button>
                                    </div>
                                </div>
                                <div class="mb-3 col-12 col-md-6">
                                    <label for="priority" class="form-label">Prioridad</label>
                                    <select class="form-select" id="priority" name="priority" required>
                                        <option value="Bajo">Bajo</option>
                                        <option value="Medio">Medio</option>
                                        <option value="Alto">Alto</option>

                                    </select>
                                </div>
                                <div class="mb-3 col-12 col-md-6">
                                    <label for="incident_date" class="form-label">Fecha de Incidente</label>
                                    <input type="datetime-local" class="form-control" id="incident_date" required
                                        name="incident_date">
                                </div>
                                <div class="mb-3 col-12">
                                    <h5 class="card-title mb-0">Documentos</h5>
                                </div>
                                <div class="mb-3 col-12 col-md-6">
                                    <label for="file" class="form-label">Evidencias</label>
                                    <input type="file" class="form-control" id="file" name="file" required>
                                </div>
                                <div class="mb-3 col-12 col-md-6">
                                    <label for="name_file" class="form-label">Descripcion Evidencias</label>
                                    <input type="text" class="form-control" id="name_file" name="name_file" required>
                                </div>
                                <div class="mb-3 col-12">
                                    <h5 class="card-title mb-0">Ticket</h5>
                                </div>
                                <div class="mb-3 col-12 col-md-6">
                                    <label for="category_id" class="form-label">Categoría</label>
                                    <select class="form-select" id="category_id" name="category_id" required>
                                        @foreach ($category as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-12 col-md-6">
                                    <label for="title" class="form-label">Asunto</label>
                                    <input type="text" class="form-control" id="title_ticket" name="title_ticket"
                                        required>
                                </div>

                                <div class="mb-3 col-12">
                                    <label for="description" class="form-label">Descripción</label>
                                    <textarea class="form-control" id="description_ticket" name="description_ticket" required rows="3"></textarea>
                                </div>
                                <div class="mb-3 col-12">
                                    <button type="submit" class="btn btn-primary">Crear Incidencia</button>
                                </div>

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
        const url_store = '{!! route('incidencias.create') !!}';
        const url_lista = '{!! route('incidencias.index') !!}';
    </script>
    <script src="{{ asset('js/create_incidencias.js') }}"></script>

@endsection
