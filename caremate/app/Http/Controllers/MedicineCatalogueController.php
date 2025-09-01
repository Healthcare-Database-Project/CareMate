<?php

namespace App\Http\Controllers;

use App\Models\MedicineCatalogue;
use Illuminate\Http\Request;

class MedicineCatalogueController extends Controller
{
    // Show all medicine
    public function index() {
        $medicines = MedicineCatalogue::orderBy('common_name','asc')->filter(request(['search']))->get();
        return view('medicinecatalogue.index', compact('medicines'));
    }

    // Show a single medicine
    public function show() {

    }

}
