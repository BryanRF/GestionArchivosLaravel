<?php

namespace App\Http\Controllers\DataTables;
use Carbon\Carbon;

use App\Http\Controllers\Controller;
use App\Models\Employee;

class EmployeeDataTables extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return datatables()->collection($employees)
            ->addColumn('actions', function ($employee) {
                return '<button class="btn btn-sm btn-primary " onclick=\'SeleccionarEmpleados("'.$employee->id.'","'.$employee->name.'")\'>Seleccionar</button>';

            })
            ->rawColumns(['actions'])
            ->toJson();
    }

    public function list()
{
    $employees = Employee::with('role')->get();
    $employees->transform(function($item, $key) {
        $item->birthdate = Carbon::parse($item->birthdate)->format('d/m/Y');
        return $item;
    });

    return datatables()->collection($employees)
        ->addColumn('actions', function ($employee) {
            $editUrl = route('empleados.edit', ['empleado' => $employee->id]); // URL de edición
            return '<a href="' . $editUrl . '" class="btn btn-sm" title="Editar"><i class="bi bi-pencil"></i></a><a href="#" class="btn btn-sm" title="eliminar"><i class="bi bi-trash"></i> </a>';
        })
        ->rawColumns(['actions'])
        ->toJson();
}
}
