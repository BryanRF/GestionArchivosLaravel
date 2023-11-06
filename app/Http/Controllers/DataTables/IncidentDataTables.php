<?php

namespace App\Http\Controllers\DataTables;

use App\Http\Controllers\Controller;
use App\Models\Incident;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
class IncidentDataTables extends Controller
{
    public function index()
{
    $data = Incident::with(['employee', 'item','documents','ticket'])->get();
    
    // Formatear la fecha
    $data->transform(function($item, $key) {
        $item->incident_date = Carbon::parse($item->incident_date)->format('d/m/Y H:i');
        return $item;
    });
    // Agregar el botón en la columna "ticket.title"
 
    return datatables()->collection($data)
    ->addColumn('actions', function ($data) {
        return '<a href="#" class="btn btn-sm "  title="editar"><i class="bi bi-pencil"></i> </a>
                    <a href="#" class="btn btn-sm" title="eliminar"><i class="bi bi-trash"></i> </a>';
    })
    ->addColumn('show_ticket', function ($data) {
        return '<a  href="'.route('show.ticket', $data->ticket->id).'" class="btn btn-sm btn-info">Ticket</a>';
    })->rawColumns(['show_ticket','actions'])
    ->toJson();
}
}
