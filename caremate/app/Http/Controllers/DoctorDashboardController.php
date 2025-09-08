<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DoctorDashboardController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $doctor = DB::table('doctor')->where('users_id', $user->users_id)->first();

        // Doctor's schedule
        $schedule = DB::table('doctor_schedule')->where('doctor_id', $doctor->doctor_id)->get();

        return view('login.doctordashboard', [
            'user' => $user,
            'doctor' => $doctor,
            'schedule' => $schedule,
        ]);
    }
    public function showProfile()
    {
        $user = Auth::user();
        $doctor = DB::table('doctor')->where('users_id', $user->users_id)->first();

        return view('login.doctorprofile', [
            'user' => $user,
            'doctor' => $doctor,
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $doctor = DB::table('doctor')->where('users_id', $user->users_id)->first();

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email,' . $user->users_id . ',users_id',
            'phone'      => 'required|string|max:20',
            'bmdc_reg_no' => 'required|string|max:50',
            'specialization' => 'required|string|max:100',
            'education'  => 'nullable|string|max:255',
            'years_of_experience' => 'nullable|integer|min:0',
            'consultation_fee' => 'nullable|numeric|min:0',
        ]);

        // Update users table
        DB::table('users')->where('users_id', $user->users_id)->update([
            'first_name' => $validated['first_name'],
            'last_name'  => $validated['last_name'],
            'email'      => $validated['email'],
        ]);

        // Update doctor table
        DB::table('doctor')->where('users_id', $user->users_id)->update([
            'phone' => $validated['phone'],
            'bmdc_reg_no' => $validated['bmdc_reg_no'],
            'specialization' => $validated['specialization'],
            'education' => $validated['education'],
            'years_of_experience' => $validated['years_of_experience'],
            'consultation_fee' => $validated['consultation_fee'],
        ]);

        return redirect()->route('doctor.profile')->with('success', 'Profile updated successfully!');
    }

    public function myPatients()
    {
        $user = Auth::user();
        $doctor = DB::table('doctor')->where('users_id', $user->users_id)->first();

        // Get all unique patients who have appointments with this doctor
        $patients = DB::table('appointment')
            ->join('patient', 'appointment.patient_id', '=', 'patient.patient_id')
            ->join('users', 'patient.users_id', '=', 'users.users_id')
            ->where('appointment.doctor_id', $doctor->doctor_id)
            ->select('patient.patient_id', 'users.first_name', 'users.last_name', 'users.email', 'patient.phone', 'patient.sex', 'patient.blood_group')
            ->distinct()
            ->get();

        return view('login.doctor_patients', [
            'patients' => $patients,
        ]);
    }

    public function patientDetails($patient_id)
    {
        // Get patient info
        $patient = DB::table('patient')
            ->join('users', 'patient.users_id', '=', 'users.users_id')
            ->where('patient.patient_id', $patient_id)
            ->select('patient.*', 'users.first_name', 'users.last_name', 'users.email')
            ->first();

        // Blood Pressure Monthly
        $startOfMonth = now()->startOfMonth()->toDateString();
        $endOfMonth = now()->endOfMonth()->toDateString();
        $bpMonth = DB::table('health_info')
            ->join('blood_pressure', 'health_info.info_id', '=', 'blood_pressure.bp_id')
            ->where('health_info.patient_id', $patient_id)
            ->whereBetween('health_info.date_of_recording', [$startOfMonth, $endOfMonth])
            ->select('health_info.date_of_recording', 'health_info.time_of_recording', 'blood_pressure.blood_pressure')
            ->orderBy('health_info.date_of_recording', 'desc')
            ->get();

        // Blood Sugar Monthly
        $bsMonth = DB::table('health_info')
            ->join('blood_sugar_level', 'health_info.info_id', '=', 'blood_sugar_level.b_sugar_id')
            ->where('health_info.patient_id', $patient_id)
            ->whereBetween('health_info.date_of_recording', [$startOfMonth, $endOfMonth])
            ->select('health_info.date_of_recording', 'health_info.time_of_recording', 'blood_sugar_level.blood_sugar_level')
            ->orderBy('health_info.date_of_recording', 'desc')
            ->get();

        // Medical History (Illnesses)
        $illnesses = DB::table('health_info')
            ->join('illness', 'health_info.info_id', '=', 'illness.illness_id')
            ->where('health_info.patient_id', $patient_id)
            ->select('health_info.date_of_recording', 'health_info.time_of_recording', 'illness.illness_name', 'illness.illness_type')
            ->orderBy('health_info.date_of_recording', 'desc')
            ->get();

        // Medicine History
        $healthInfos = DB::table('health_info')->where('patient_id', $patient_id)->pluck('info_id');
        $medicineHistory = DB::table('medicine_log')
            ->join('medicine_catalogue', 'medicine_log.medicine_id', '=', 'medicine_catalogue.medicine_id')
            ->whereIn('medicine_log.mlog_id', $healthInfos)
            ->select('medicine_catalogue.common_name as medicine_name', 'medicine_log.prescription_start_date', 'medicine_log.prescription_end_date')
            ->get();

        return view('login.doctor_patient_details', [
            'patient' => $patient,
            'bpMonth' => $bpMonth,
            'bsMonth' => $bsMonth,
            'illnesses' => $illnesses,
            'medicineHistory' => $medicineHistory,
        ]);
    }

    public function addSchedule(Request $request)
    {
        $user = Auth::user();
        $doctor = DB::table('doctor')->where('users_id', $user->users_id)->first();

        $validated = $request->validate([
            'day_of_week' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'max_appointments' => 'required|integer|min:1',
        ]);

        // Check for overlapping schedules for the same doctor and day
        $overlap = DB::table('doctor_schedule')
            ->where('doctor_id', $doctor->doctor_id)
            ->where('day_of_week', $validated['day_of_week'])
            ->where(function($query) use ($validated) {
                $query->whereBetween('start_time', [$validated['start_time'], $validated['end_time']])
                    ->orWhereBetween('end_time', [$validated['start_time'], $validated['end_time']])
                    ->orWhere(function($q) use ($validated) {
                        $q->where('start_time', '<=', $validated['start_time'])
                            ->where('end_time', '>=', $validated['end_time']);
                    });
            })
            ->exists();

        if ($overlap) {
            return redirect()->route('doctordashboard')->with('error', 'Schedule overlaps with an existing entry!');
        }

        DB::table('doctor_schedule')->insert([
            'doctor_id' => $doctor->doctor_id,
            'day_of_week' => $validated['day_of_week'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'max_appointments' => $validated['max_appointments'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('doctordashboard')->with('success', 'Schedule added!');
    }

    public function deleteSchedule($schedule_id)
    {
        $user = Auth::user();
        $doctor = DB::table('doctor')->where('users_id', $user->users_id)->first();

        // Use 'schedule_id' instead of 'id'
        DB::table('doctor_schedule')
            ->where('doctor_id', $doctor->doctor_id)
            ->where('schedule_id', $schedule_id)
            ->delete();

        return redirect()->route('doctordashboard')->with('success', 'Schedule entry removed!');
    }

    public function doctorsAppointments()
    {
    $user = Auth::user();
    // Find the doctor_id for the logged-in user
    $doctor = DB::table('doctor')->where('users_id', $user->users_id)->first();

    // Get all upcoming appointments for this doctor
    $appointments = DB::table('appointment')
        ->where('doctor_id', $doctor->doctor_id)
        ->where(function($query) {
            $query->where('appointment_date', '>', now()->toDateString())
                  ->orWhere(function($q) {
                      $q->where('appointment_date', now()->toDateString())
                        ->where('appointment_time', '>=', now()->toTimeString());
                  });
        })
        ->orderBy('appointment_date')
        ->orderBy('appointment_time')
        ->get();

    // Collect patient user IDs
    $patientIds = $appointments->pluck('patient_id')->unique();
    $patients = DB::table('patient')
        ->whereIn('patient_id', $patientIds)
        ->get()
        ->keyBy('patient_id');

    $userIds = $patients->pluck('users_id')->unique();
    $users = DB::table('users')
        ->whereIn('users_id', $userIds)
        ->get()
        ->keyBy('users_id');

    // Prepare data for the view
    $appointmentData = $appointments->map(function($appt) use ($patients, $users) {
        $patient = $patients[$appt->patient_id] ?? null;
        $user = $patient ? ($users[$patient->users_id] ?? null) : null;
        return [
            'patient_name' => $user ? ($user->first_name . ' ' . $user->last_name) : 'Unknown',
            'appointment_time' => $appt->appointment_time,
            'appointment_day' => \Carbon\Carbon::parse($appt->appointment_date)->format('l'),
            'appointment_date' => $appt->appointment_date,
        ];
    });

    return view('login.doctorsappointments', [
        'appointments' => $appointmentData,
    ]);
    }
}
