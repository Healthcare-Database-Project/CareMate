<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PatientDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $patient = DB::table('patient')->where('users_id', $user->users_id)->first();

        // Medicine history
        $medicineHistory = [];
        if ($patient) {
            $healthInfos = DB::table('health_info')->where('patient_id', $patient->patient_id)->pluck('info_id');
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

        // Blood Pressure for this week
        $bpWeek = [];
        if ($patient) {
            $startOfWeek = Carbon::now()->startOfWeek();
            $endOfWeek = Carbon::now()->endOfWeek();
            $bpWeek = DB::table('health_info')
                ->join('blood_pressure', 'health_info.info_id', '=', 'blood_pressure.bp_id')
                ->where('health_info.patient_id', $patient->patient_id)
                ->whereBetween('health_info.date_of_recording', [$startOfWeek->toDateString(), $endOfWeek->toDateString()])
                ->select('health_info.date_of_recording', 'health_info.time_of_recording', 'blood_pressure.blood_pressure')
                ->orderBy('health_info.date_of_recording', 'desc')
                ->orderBy('health_info.time_of_recording', 'desc')
                ->get();
        }

        // Blood Sugar for this week
        $bsWeek = [];
        if ($patient) {
            $startOfWeek = Carbon::now()->startOfWeek();
            $endOfWeek = Carbon::now()->endOfWeek();
            $bsWeek = DB::table('health_info')
                ->join('blood_sugar_level', 'health_info.info_id', '=', 'blood_sugar_level.b_sugar_id')
                ->where('health_info.patient_id', $patient->patient_id)
                ->whereBetween('health_info.date_of_recording', [$startOfWeek->toDateString(), $endOfWeek->toDateString()])
                ->select('health_info.date_of_recording', 'health_info.time_of_recording', 'blood_sugar_level.blood_sugar_level')
                ->orderBy('health_info.date_of_recording', 'desc')
                ->orderBy('health_info.time_of_recording', 'desc')
                ->get();
        }

        return view('login.userdashboard', [
            'user' => $user,
            'patient' => $patient,
            'medicineHistory' => $medicineHistory,
            'bpWeek' => $bpWeek,
            'bsWeek' => $bsWeek,
        ]);
    }

    public function logBloodPressure(Request $request)
    {
        $user = Auth::user();
        $patient = DB::table('patient')->where('users_id', $user->users_id)->first();

        $validated = $request->validate([
            'date_of_recording' => 'required|date',
            'time_of_recording' => 'required',
            'blood_pressure'    => 'required|string|max:20',
        ]);

        // Insert into health_info
        $info_id = DB::table('health_info')->insertGetId([
            'date_of_recording' => $validated['date_of_recording'],
            'time_of_recording' => $validated['time_of_recording'],
            'patient_id'        => $patient->patient_id,
        ]);

        // Insert into blood_pressure
        DB::table('blood_pressure')->insert([
            'bp_id'          => $info_id,
            'blood_pressure' => $validated['blood_pressure'],
        ]);

        return redirect()->route('userdashboard')->with('success', 'Blood pressure logged!');
    }

    public function monthlyBloodPressure()
    {
        $user = Auth::user();
        $patient = DB::table('patient')->where('users_id', $user->users_id)->first();

        $bpMonth = [];
        if ($patient) {
            $startOfMonth = Carbon::now()->startOfMonth();
            $endOfMonth = Carbon::now()->endOfMonth();
            $bpMonth = DB::table('health_info')
                ->join('blood_pressure', 'health_info.info_id', '=', 'blood_pressure.bp_id')
                ->where('health_info.patient_id', $patient->patient_id)
                ->whereBetween('health_info.date_of_recording', [$startOfMonth->toDateString(), $endOfMonth->toDateString()])
                ->select('health_info.date_of_recording', 'health_info.time_of_recording', 'blood_pressure.blood_pressure')
                ->orderBy('health_info.date_of_recording', 'desc')
                ->orderBy('health_info.time_of_recording', 'desc')
                ->get();
        }

        $sumSystolic = 0;
        $sumDiastolic = 0;
        $count = 0;

        foreach ($bpMonth as $bp) {
            if (preg_match('/(\d+)\s*\/\s*(\d+)/', $bp->blood_pressure, $matches)) {
                $sumSystolic += (int)$matches[1];
                $sumDiastolic += (int)$matches[2];
                $count++;
            }
        }

        $avgSystolic = $count ? round($sumSystolic / $count) : null;
        $avgDiastolic = $count ? round($sumDiastolic / $count) : null;

        // Determine status
        $status = '';
        if ($avgSystolic && $avgDiastolic) {
            if ($avgSystolic > 130 || $avgDiastolic > 89) {
                $status = 'High Blood Pressure';
            } elseif ($avgSystolic < 90 || $avgDiastolic < 60) {
                $status = 'Low Blood Pressure';
            } else {
                $status = 'Normal';
            }
        }
        

        return view('login.bp_monthly', [
            'bpMonth' => $bpMonth,
            'avgSystolic' => $avgSystolic,
            'avgDiastolic' => $avgDiastolic,
            'status' => $status,
        ]);
    }

    // Log blood sugar
    public function logBloodSugar(Request $request)
    {
        $user = Auth::user();
        $patient = DB::table('patient')->where('users_id', $user->users_id)->first();

        $validated = $request->validate([
            'date_of_recording' => 'required|date',
            'time_of_recording' => 'required',
            'blood_sugar'       => 'required|numeric|min:0',
        ]);

        // Insert into health_info
        $info_id = DB::table('health_info')->insertGetId([
            'date_of_recording' => $validated['date_of_recording'],
            'time_of_recording' => $validated['time_of_recording'],
            'patient_id'        => $patient->patient_id,
        ]);

        // Insert into blood_sugar
        DB::table('blood_sugar_level')->insert([
            'b_sugar_id'        => $info_id,
            'blood_sugar_level' => $validated['blood_sugar'],
        ]);

        return redirect()->route('userdashboard')->with('success', 'Blood sugar logged!');
    }

    // Monthly blood sugar report
    public function monthlyBloodSugar()
    {
        $user = Auth::user();
        $patient = DB::table('patient')->where('users_id', $user->users_id)->first();

        $bsMonth = [];
        if ($patient) {
            $startOfMonth = Carbon::now()->startOfMonth();
            $endOfMonth = Carbon::now()->endOfMonth();
            $bsMonth = DB::table('health_info')
                ->join('blood_sugar_level', 'health_info.info_id', '=', 'blood_sugar_level.b_sugar_id')
                ->where('health_info.patient_id', $patient->patient_id)
                ->whereBetween('health_info.date_of_recording', [$startOfMonth->toDateString(), $endOfMonth->toDateString()])
                ->select('health_info.date_of_recording', 'health_info.time_of_recording', 'blood_sugar_level.blood_sugar_level')
                ->orderBy('health_info.date_of_recording', 'desc')
                ->orderBy('health_info.time_of_recording', 'desc')
                ->get();
        }

        // Calculate average and status
        $avgSugar = $bsMonth->count() ? round($bsMonth->avg('blood_sugar_level'), 2) : null;
        $status = '';
        if ($avgSugar !== null) {
            if ($avgSugar > 125) {
                $status = 'High Blood Sugar';
            } elseif ($avgSugar < 70) {
                $status = 'Low Blood Sugar';
            } else {
                $status = 'Normal';
            }
        }

        return view('login.bsugar_monthly', [
            'bsMonth' => $bsMonth,
            'avgSugar' => $avgSugar,
            'status' => $status,
        ]);
    }

    public function showProfile()
    {
        $user = Auth::user();
        $patient = DB::table('patient')->where('users_id', $user->users_id)->first();

        return view('login.patientprofile', [
            'user' => $user,
            'patient' => $patient
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'first_name'        => 'required|string|max:255',
            'last_name'         => 'required|string|max:255',
            'email'             => 'required|email|unique:users,email,' . $user->users_id . ',users_id',
            'gender'            => 'required|in:Male,Female,Other',
            'phone'             => 'required|string|max:20',
            'address'           => 'nullable|string|max:255',
            'blood_group'       => 'nullable|string|max:10',
            'emergency_contact' => 'nullable|string|max:20',
        ]);

        // Update user table
        DB::table('users')->where('users_id', $user->users_id)->update([
            'first_name' => $validated['first_name'],
            'last_name'  => $validated['last_name'],
            'email'      => $validated['email'],
        ]);

        // Update patient table
        DB::table('patient')->where('users_id', $user->users_id)->update([
            'sex'               => $validated['gender'],
            'phone'             => $validated['phone'],
            'address'           => $validated['address'],
            'blood_group'       => $validated['blood_group'],
            'emergency_contact' => $validated['emergency_contact'],
        ]);

        return redirect()->route('patient.profile')->with('success', 'Profile updated successfully!');
    }
    // Log illness
    public function logIllness(Request $request)
    {
        $user = Auth::user();
        $patient = DB::table('patient')->where('users_id', $user->users_id)->first();

        $validated = $request->validate([
            'date_of_recording' => 'required|date',
            'time_of_recording' => 'required',
            'illness_name'      => 'required|string|max:100',
            'illness_type'      => 'required|string|max:100',
        ]);

        // Insert into health_info
        $info_id = DB::table('health_info')->insertGetId([
            'date_of_recording' => $validated['date_of_recording'],
            'time_of_recording' => $validated['time_of_recording'],
            'patient_id'        => $patient->patient_id,
        ]);

        // Insert into illness
        DB::table('illness')->insert([
            'illness_id'    => $info_id,
            'illness_name'  => $validated['illness_name'],
            'illness_type'  => $validated['illness_type'],
        ]);

        return redirect()->route('userdashboard')->with('success', 'Illness record added!');
    }

    // Medical history page
    public function medicalHistory()
    {
        $user = Auth::user();
        $patient = DB::table('patient')->where('users_id', $user->users_id)->first();

        $illnesses = [];
        if ($patient) {
            $illnesses = DB::table('health_info')
                ->join('illness', 'health_info.info_id', '=', 'illness.illness_id')
                ->where('health_info.patient_id', $patient->patient_id)
                ->select('health_info.date_of_recording', 'health_info.time_of_recording', 'illness.illness_name', 'illness.illness_type')
                ->orderBy('health_info.date_of_recording', 'desc')
                ->orderBy('health_info.time_of_recording', 'desc')
                ->get();
        }

        return view('login.medical_history', [
            'illnesses' => $illnesses,
        ]);
    }
}