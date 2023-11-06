<?php

namespace App\Http\Controllers\DataTables;

use App\Http\Controllers\Controller;
use App\Models\Item;

class ItemDataTables extends Controller
{
    public function index()
    {
        $items = Item::all();

        return datatables()->collection($items)
            ->addColumn('actions', function ($item) {
                return '<button class="btn btn-sm btn-primary">Ver</button>';
            })
            ->rawColumns(['actions'])
            ->toJson();
    }
}
