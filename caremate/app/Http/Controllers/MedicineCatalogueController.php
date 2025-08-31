<?php

namespace App\Http\Controllers;

use App\Models\MedicineCatalogue;
use Illuminate\Http\Request;

class MedicineCatalogueController extends Controller
{
    // Show all medicine
    public function index() {
        return view('medicinecatalogue.index', [
            'medicines' => MedicineCatalogue::orderBy('common_name','asc')->filter(request(['search']))->get()
        ]);
    }

    // Show a single medicine
    public function show() {

    }

}
