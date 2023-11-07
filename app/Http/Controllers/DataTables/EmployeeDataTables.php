<?php

namespace App\Http\Controllers\DataTables;

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
}
