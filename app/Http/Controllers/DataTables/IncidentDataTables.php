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
        $data = Incident::with(['employee', 'item','documents','student'])->orderBy('incidents.created_at', 'desc')->get();

        // Formatear la fecha
        $data->transform(function($item, $key) {
            $item->incident_date = Carbon::parse($item->incident_date)->format('d/m/Y H:i');
            return $item;
        });
        $data->transform(function($item, $key) {
            if ($item->incident_review === null) {
                $item->formatted_incident_review = 'No revisado';
            } else {
                $item->formatted_incident_review = Carbon::parse($item->incident_review)->format('d/m/Y H:i');
            }
            return $item;
        });
        // Agregar el botón en la columna "ticket.title"

        return datatables()->collection($data)
        ->addColumn('actions', function ($data) {
            return '<a href="#" class="btn btn-sm "  title="Revisar"><i class="bi bi-eye"></i> </a><a href="#" class="btn btn-sm" title="eliminar"><i class="bi bi-trash"></i> </a>';
        })


        ->addColumn('status_badge', function ($data) {
            $badgeClass = '';
            switch ($data->status) {
                case 'Pendiente':
                    $badgeClass = 'bg-warning';
                    break;
                case 'Revisado':
                    $badgeClass = 'bg-success';
                    break;
                case 'Anulado':
                    $badgeClass = 'bg-danger';
                    break;
                default:
                    $badgeClass = 'bg-secondary';
                    break;
            }
            return '<span class="badge ' . $badgeClass . '">' . $data->status . '</span>';
        })->addColumn('priority_badge', function ($data) {
            $badgeClass = '';
            switch ($data->priority) {
                case 'Medio':
                    $badgeClass = 'bg-warning';
                    break;
                case 'Bajo':
                    $badgeClass = 'bg-success';
                    break;
                case 'Alto':
                    $badgeClass = 'bg-danger';
                    break;
                default:
                    $badgeClass = 'bg-secondary';
                    break;
            }
            return '<span class="badge ' . $badgeClass . '">' . $data->priority . '</span>';
        })
        ->rawColumns(['actions', 'status_badge','priority_badge'])
        ->toJson();
    }

}
