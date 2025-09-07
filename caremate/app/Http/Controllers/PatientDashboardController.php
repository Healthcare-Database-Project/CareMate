<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PatientDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Find patient_id for this user
        $patient = DB::table('patient')->where('users_id', $user->users_id)->first();
        $medicineHistory = [];
        if ($patient) {
            // Get all health_info entries for this patient
            $healthInfos = DB::table('health_info')->where('patient_id', $patient->patient_id)->pluck('info_id');

            // Join medicine_log and medicine_catalogue to get medicine history
            $medicineHistory = DB::table('medicine_log')
                ->join('medicine_catalogue', 'medicine_log.medicine_id', '=', 'medicine_catalogue.medicine_id')
                ->whereIn('medicine_log.mlog_id', $healthInfos)
                ->select(
                    'medicine_catalogue.common_name as medicine_name',
                    'medicine_log.prescription_start_date',
                    'medicine_log.prescription_end_date'
                )
                ->get();
        }

        return view('login.userdashboard', [
            'user' => $user,
            'medicineHistory' => $medicineHistory
        ]);
    }
}