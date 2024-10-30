<?php

namespace App\Http\Controllers\DataTables;
use Carbon\Carbon;

use App\Http\Controllers\Controller;
use App\Models\Employee;

class EmployeeDataTables extends Controller
{
    public function index()
    {
        try {
            $employees = Employee::select('id', 'name', 'dni')->where('active', true)->get();
            return datatables()->collection($employees)
                ->addColumn('actions', function ($employee) {
                    return '<button class="btn btn-sm btn-primary" onclick="SeleccionarEmpleados(\''.$employee->id.'\',\''.$employee->name.'\')">Seleccionar</button>';
                })
                ->rawColumns(['actions'])
                ->toJson();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

  // EmployeeDataTables.php necesita actualización
public function list()
{
    $employees = Employee::with('role')->get();
    return datatables()->collection($employees)
        ->addColumn('actions', function ($employee) {
            $editUrl = route('empleados.edit', $employee->id);
            return '<a href="'.$editUrl.'" class="btn btn-sm" title="Editar"><i class="bi bi-pencil"></i></a>
                    <button onclick="deleteItem(\''.$employee->id.'\')" class="btn btn-sm" title="eliminar"><i class="bi bi-trash"></i></button>';
        })
        ->rawColumns(['actions'])
        ->toJson();
}
}
