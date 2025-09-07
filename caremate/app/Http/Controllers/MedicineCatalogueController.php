<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicineCatalogue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function tracker()
    {
        $medicines = MedicineCatalogue::all();
        return view('medicinecatalogue.tracker', compact('medicines'));
    }

    public function addToTracker(Request $request)
    {
        $request->validate([
            'medicine_id' => 'required|exists:medicine_catalogue,medicine_id',
            'date_of_recording' => 'required|date',
            'prescription_start_date' => 'required|date',
            'prescription_end_date' => 'required|date|after_or_equal:prescription_start_date',
        ]);

        // Find patient_id for the logged-in user
        $userId = Auth::id();
        $patient = DB::table('patient')->where('users_id', $userId)->first();

        if (!$patient) {
            return redirect()->back()->with('error', 'Patient record not found.');
        }

        // Insert into health_info table with patient_id
        $healthInfoId = DB::table('health_info')->insertGetId([
            'patient_id' => $patient->patient_id, // Insert patient_id here
            'date_of_recording' => $request->date_of_recording,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert into medicine_log table
        DB::table('medicine_log')->insert([
            'mlog_id' => $healthInfoId,
            'medicine_id' => $request->medicine_id,
            'prescription_start_date' => $request->prescription_start_date,
            'prescription_end_date' => $request->prescription_end_date,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('medicinecatalogue.tracker')->with('success', 'Medicine added to tracker!');
    }

}
