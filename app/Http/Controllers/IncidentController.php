<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Incident;

class IncidentController extends Controller
{

    public function index()
    {
        $incidents = Incident::all();
        return view('incidents.index', compact('incidents'));
    }


    public function create()
    {
        $category = Category::all();
        return view('incidents.create',compact('category'));
    }


    public function show($id)
{
    $incident = Incident::with(['employee', 'item', 'documents'])->findOrFail($id);
    return view('incidents.show', compact('incident'));
}


    public function edit($id)
    {
        $incident = Incident::find($id);
        return view('incidents.edit', compact('incident'));
    }


}
