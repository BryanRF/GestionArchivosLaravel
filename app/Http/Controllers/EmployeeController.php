<?php
namespace App\Http\Controllers;
use App\Http\Requests\UpdateEmployee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Role;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\User;

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
    public function show($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            return view('employees.show', compact('employee'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Empleado no encontrado: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $hasAccess = $request->has('has_access');

            if ($hasAccess) {
                // Generar una contraseña aleatoria
                $randomPassword = Str::random(8); // Esto generará una cadena aleatoria de 8 caracteres
            }

            // Crear un nuevo usuario solo si tiene acceso
            if ($hasAccess) {
                $user = User::create([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => bcrypt($randomPassword), // Asignar la contraseña generada
                    'active' => true,
                ]);
            }
            $employee = new Employee([
                'name' => $request->input('name'),
                'dni' => $request->input('dni'),
                'user_id' =>$hasAccess ? $user->id : null,
                'active' => true, // Puedes modificar este valor según tus necesidades
                'address' => $request->input('address'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'birthdate' => $request->input('birthdate'),
                'role_id' => $request->input('role_id'),
            ]);
            $employee->save();

            return response()->json([
                'message' => 'Empleado creado exitosamente',
                'code' => 201,
                'status' => 'success',
                'title' => 'Empleado Creado',
                'employee' => $employee
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code' => 400,
                'status' => 'error',
                'title' => 'Error al crear empleado'
            ], 500);
        }
    }


    public function update(UpdateEmployee $request, Employee $employee)
    {
        try {
            DB::beginTransaction();

            $hasAccess = $request->has('has_access');

            if ($hasAccess) {
                // Si tiene acceso, actualizamos el usuario o creamos uno nuevo si no lo tiene
                $user = $employee->user;

                if (!$user) {
                    $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => bcrypt(Str::random(8)),
                        'active' => true,
                    ]);
                    $employee->user_id = $user->id;
                } else {
                    $user->update([
                        'name' => $request->name,
                        'email' => $request->email,
                    ]);
                }
            } elseif ($employee->user) {
                // Si no tiene acceso pero tenía un usuario, lo eliminamos
                $employee->user->delete();
                $employee->user_id = null;
                $employee->save();
            }
            $data = (['name' => $request->name,
                'dni' => $request->dni,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'birthdate' => $request->birthdate,
                'role_id' => $request->role_id]);

            $employee->update($data);
            DB::commit();
            session()->flash('success', $employee);
            return redirect()->route('empleados.index');

        }  catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollback();
            // Manejar el error y proporcionar un mensaje de error
            return redirect()->back()->with('error', 'Error al actualizar empleado: ' . $e->getMessage());
        }
    }

}
