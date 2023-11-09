<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employees.index');
    }
    public function create()
    {
        $roles=Role::where('is_student',false)->get();
        return view('employees.create',compact('roles'));
    }
    public function edit($id)
    {
        $employee=Employee::find($id);
        $roles=Role::where('is_student',false)->get();
        return view('employees.edit',compact('roles','employee'));
    }

}
