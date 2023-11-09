<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class EmployeesControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    /**
 * Update the specified resource in storage.
 */
public function update(Request $request, string $id)
{
    try {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json([
                'message' => 'Empleado no encontrado',
                'code' => 404,
                'status' => 'error',
                'title' => 'Empleado no Encontrado'
            ], 404);
        }

        $hasAccess = $request->has('has_access');

        if ($hasAccess) {
            // Si tiene acceso, actualizamos el usuario o creamos uno nuevo si no lo tiene
            $user = $employee->user;

            if (!$user) {
                $user = User::create([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => bcrypt(Str::random(8)), // Generar una contraseña aleatoria si es nuevo
                    'active' => true,
                ]);
                $employee->user_id = $user->id;
            } else {
                $user->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                ]);
            }
        } elseif ($employee->user) {
            // Si no tiene acceso pero tenía un usuario, lo eliminamos
            $employee->user->delete();
            $employee->user_id = null;
        }

        $employee->name = $request->input('name');
        $employee->dni = $request->input('dni');
        $employee->address = $request->input('address');
        $employee->phone = $request->input('phone');
        $employee->email = $request->input('email');
        $employee->birthdate = $request->input('birthdate');
        $employee->role_id = $request->input('role_id');

        $employee->save();

        return response()->json([
            'message' => 'Empleado actualizado exitosamente',
            'code' => 200,
            'status' => 'success',
            'title' => 'Empleado Actualizado',
            'employee' => $employee
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'message' => $e->getMessage(),
            'code' => 400,
            'status' => 'error',
            'title' => 'Error al actualizar empleado'
        ], 500);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
