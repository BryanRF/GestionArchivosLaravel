<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Incident;
use App\Models\Ticket;
use App\Models\Document;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class IncidentControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function review(Request $request, $id)
    {
        try {
            $incident = Incident::findOrFail($id);

            $incident->update([
                'status' => 'Revisado',
                'incident_review' => now(),
                'review_notes' => $request->notes
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Incidencia revisada correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{


    try {


            $incident = new Incident([
                'employee_id' => $request->input('employee_id'),
                'item_id' => $request->input('item_id'),
                'user_id' => $request->input('qwec8a4s81c818e51'),
                'priority' => $request->input('priority'),
                'incident_date' => $request->input('incident_date'),
                'status' => 'Pendiente',
                'title' => $request->input('title_ticket'),
                'description' => $request->input('description_ticket'),
            ]);
            $incident->save();

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $extension = $file->getClientOriginalExtension();
                $filename = Str::uuid() . '.' . $extension;
                $file->storeAs('documentos', $filename, 'public');

                // Determinar el icono y color basado en la extensión del archivo
                $icon = '';
                $color = '';

                switch ($extension) {
                    case 'pdf':
                        $icon = 'bi bi-file-earmark-pdf';
                        $color = 'btn-danger'; // Rojo
                        break;
                    case 'doc':
                    case 'docx':
                        $icon = 'bi bi-file-earmark-word';
                        $color = 'btn-primary'; // Azul
                        break;
                    case 'xls':
                    case 'xlsx':
                        $icon = 'bi bi-file-earmark-excel';
                        $color = 'btn-success'; // Verde
                        break;
                    case 'rar':
                    case 'tar':
                    case 'zip':
                        $icon = 'bi bi-file-earmark-zip';
                        $color = 'btn-warning'; // Amarillo
                        break;
                    case 'jpg':
                    case 'jpeg':
                    case 'png':
                    case 'gif':
                    case 'webp':
                        $icon = 'bi bi-card-image';
                        $color = 'btn-info'; // Azul claro
                        break;
                    // Agrega más casos según sea necesario para otros tipos de archivo
                    default:
                        $icon = 'bi bi-file-earmark';
                        $color = 'btn-secondary'; // Gris
                }

                $documento = new Document([
                    'name' =>$request->input('name_file'),
                    'file' => $filename,
                    'icon' => $icon,
                    'color' => $color,
                    'tipo' => strtoupper($extension)
                ]);

                $incident->documents()->save($documento);
            }

            return response()->json([
                'message' => 'Incidente creado exitosamente',
                'code' => 201,
                'status' => 'success',
                'title' => 'Incidente Creado',
                'incident' => $incident
            ], 201);

    } catch (\Exception $e) {
        return response()->json([
            'message' => $e->getMessage(),
            'code' => 400 ,
            'status' => 'error',
            'title' => 'Error al crear incidente'
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
