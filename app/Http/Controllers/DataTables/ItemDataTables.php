<?php

namespace App\Http\Controllers\DataTables;

use App\Http\Controllers\Controller;
use App\Models\Item;

class ItemDataTables extends Controller
{
    public function index()
    {
        $items = Item::with('category')->get();

        return datatables()->collection($items)
            ->addColumn('actions', function ($item) {
                return '<button class="btn btn-sm btn-primary " onclick=\'SeleccionarItem("'.$item->id.'","'.$item->name.'")\'>Seleccionar</button>';
            })
            ->rawColumns(['actions'])
            ->toJson();
    }
}
