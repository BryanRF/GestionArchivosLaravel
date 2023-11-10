@extends('layouts.base')

@section('title', 'Gestion de Incidencias')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-3 text-start">Gestion de Personal</h1>
                <a href="{{ route('empleados.create') }}" class="btn btn-primary text-end">Nueva Registro</a>
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
                                        <th>Nombre</th>
                                        <th>DNI</th>
                                        <th>Oficio</th>
                                        <th>Direccion</th>
                                        <th>Telefono</th>
                                        <th>Email</th>
                                        <th>Fecha Nac.</th>
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
    @if (session()->has('success'))
        <script>
            Toast.fire({
                icon: 'success',
                title: "{{ session('success') }}"
            })
        </script>
    @endif
    <script>
        const url_api = '{!! route('employees.list.datatables') !!}';
        const modulo = 'Empleados';
    </script>
    <script src="{{ asset('js/employees.js') }}"></script>

@endsection
