@extends('layouts.base')

@section('title', 'Gestion de Incidencias')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-3 text-start">Gestion de Personal</h1>
                <a href="{{ route('empleados.index') }}" class="btn btn-danger text-end">Regresar</a>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Nuevo Registro</h5>

                        </div>
                        <div class="card-body">
                            <form id="form-table" class="row">

                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="dni" class="form-label">DNI</label>
                                            <input type="text" class="form-control" id="dni" name="dni"
                                                required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="address" class="form-label">Dirección</label>
                                            <input type="text" class="form-control" id="address" name="address">
                                        </div>
                                        <div class="mb-3">
                                            <label for="role_id" class="form-label">Oficio</label>
                                            <select class="form-select" id="role_id" name="role_id" required>
                                                @foreach ($roles as $data)
                                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Teléfono</label>
                                            <input type="text" class="form-control" id="phone" name="phone">
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Correo Electrónico</label>
                                            <input type="email" class="form-control" id="email" name="email">
                                        </div>
                                        <div class="mb-3">
                                            <label for="birthdate" class="form-label">Fecha de Nacimiento</label>
                                            <input type="date" class="form-control" id="birthdate" name="birthdate">
                                        </div>
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" id="has_access"
                                                name="has_access">
                                            <label class="form-check-label" for="has_access">Acceso al sistema (Se creara un
                                                Usuario y se enviada un correo con sus credenciales)</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
    <script>
        const url_store = '{!! route('empleados.store') !!}';
        const url_lista = '{!! route('empleados.index') !!}';
    </script>
    <script src="{{ asset('js/create_empleados.js') }}"></script>

@endsection
