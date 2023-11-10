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
                            <h5 class="card-title mb-0">Editar Registro</h5>

                        </div>
                        <div class="card-body">
                            {!! Form::open([
                                'route' => ['empleados.update', $employee],
                                'method' => 'put',
                                'class' => 'row',
                            ]) !!}
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <input type="hidden" id="employee_id" name="employee_id" value="{{ $employee->id }}">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        {!! Form::label('name', 'Nombre', ['class' => 'form-label']) !!}
                                        {!! Form::text('name', $employee->name, ['class' => 'form-control', 'required']) !!}
                                    </div>
                                    <div class="mb-3">
                                        {!! Form::label('dni', 'DNI', ['class' => 'form-label']) !!}
                                        {!! Form::text('dni', $employee->dni, ['class' => 'form-control', 'required']) !!}
                                    </div>
                                    <div class="mb-3">
                                        {!! Form::label('address', 'Dirección', ['class' => 'form-label']) !!}
                                        {!! Form::text('address', $employee->address, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="mb-3">
                                        {!! Form::label('role_id', 'Oficio', ['class' => 'form-label']) !!}
                                        {!! Form::select('role_id', $roles->pluck('name', 'id'), $employee->role_id, [
                                            'class' => 'form-select',
                                            'required',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        {!! Form::label('phone', 'Teléfono', ['class' => 'form-label']) !!}
                                        {!! Form::text('phone', $employee->phone, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="mb-3">
                                        {!! Form::label('email', 'Correo Electrónico', ['class' => 'form-label']) !!}
                                        {!! Form::email('email', $employee->email, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="mb-3">
                                        {!! Form::label('birthdate', 'Fecha de Nacimiento', ['class' => 'form-label']) !!}
                                        {!! Form::date('birthdate', $employee->birthdate, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="mb-3 form-check">
                                        {!! Form::checkbox('has_access', 1, false, ['class' => 'form-check-input', 'id' => 'has_access']) !!}
                                        {!! Form::label(
                                            'has_access',
                                            'Acceso al sistema (Se creará un Usuario y se enviará un correo con sus credenciales)',
                                            ['class' => 'form-check-label'],
                                        ) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                {!! Form::button('Guardar', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                            </div>
                            {!! Form::close() !!}



                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>


@endsection
