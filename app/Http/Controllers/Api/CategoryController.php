<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = Category::all();
            return response()->json([
                'message' => 'Categorías obtenidas exitosamente',
                'code' => 200,
                'status' => 'success',
                'title' => 'Categorías',
                'categories' => $categories
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'status' => 'error',
                'title' => 'Error al obtener categorías'
            ], 500);
        }
    }

    /**
     * Almacenar un recurso recién creado en el almacenamiento.
     */
    public function store(Request $request)
{
    try {
        $request->validate([
            'name' => 'required|string|max:150|unique:categories',
            'active' => 'boolean'
        ], [
            'name.required' => 'El nombre es requerido.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no puede tener más de 150 caracteres.',
            'name.unique' => 'Ya existe una categoría con este nombre.',
            'active.boolean' => 'El campo activo debe ser verdadero o falso.'
        ]);

        $validatedData = $request->validated();

        if ($validatedData) {
            $category = Category::create([
                'name' => $request->input('name'),
                'active' => $request->input('active', true)
            ]);

            return response()->json([
                'message' => 'Categoría creada exitosamente',
                'code' => 201,
                'status' => 'success',
                'title' => 'Categoría Creada',
                'category' => $category
            ], 201);
        } else {
            return response()->json([
                'message' => $request->errors()->first(),
                'code' => 422,
                'status' => 'error',
                'title' => 'Error de validación'
            ], 422);
        }
    } catch (\Exception $e) {
        return response()->json([
            'message' => $e->getMessage(),
            'code' => $e->getCode(),
            'status' => 'error',
            'title' => 'Error al crear categoría'
        ], 500);
    }
}


    /**
     * Mostrar el recurso especificado.
     */
    public function show(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            return response()->json([
                'message' => 'Categoría obtenida exitosamente',
                'code' => 200,
                'status' => 'success',
                'title' => 'Categoría',
                'category' => $category
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'status' => 'error',
                'title' => 'Error al obtener categoría'
            ], 500);
        }
    }

    /**
     * Actualizar el recurso especificado en el almacenamiento.
     */
    public function update(Request $request, string $id)
{
    try {
        $request->validate([
            'name' => 'string|max:150|unique:categories,name,'.$id,
            'active' => 'boolean'
        ], [
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no puede tener más de 150 caracteres.',
            'name.unique' => 'Ya existe una categoría con este nombre.',
            'active.boolean' => 'El campo activo debe ser verdadero o falso.'
        ]);

        $validatedData = $request->validated();

        if ($validatedData) {
            $category = Category::findOrFail($id);
            $category->update([
                'name' => $request->input('name', $category->name),
                'active' => $request->input('active', $category->active)
            ]);

            return response()->json([
                'message' => 'Categoría actualizada exitosamente',
                'code' => 200,
                'status' => 'success',
                'title' => 'Categoría Actualizada',
                'category' => $category
            ]);
        } else {
            return response()->json([
                'message' => $request->errors()->first(),
                'code' => 422,
                'status' => 'error',
                'title' => 'Error de validación'
            ], 422);
        }
    } catch (\Exception $e) {
        return response()->json([
            'message' => $e->getMessage(),
            'code' => $e->getCode(),
            'status' => 'error',
            'title' => 'Error al actualizar categoría'
        ], 500);
    }
}

    /**
     * Eliminar el recurso especificado del almacenamiento.
     */
    public function destroy(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            return response()->json([
                'message' => 'Categoría eliminada exitosamente',
                'code' => 200,
                'status' => 'success',
                'title' => 'Categoría Eliminada'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'status' => 'error',
                'title' => 'Error al eliminar categoría'
            ], 500);
        }
    }
}
