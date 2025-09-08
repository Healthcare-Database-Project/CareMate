<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('user')->get();
        return view('appointments.index', compact('doctors'));
    }

    public function create()
    {
        $doctors = Doctor::with('user')->get();
        return view('appointments.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctor,doctor_id',
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => 'required',
            'patient_name' => 'required|string|max:255',
            'patient_phone' => 'required|string|max:20',
            'patient_email' => 'required|email|max:255',
            'symptoms' => 'nullable|string'
        ]);

        if (!auth()->check()) {
        return redirect()->route('appointments.index')->with('error', 'You must be logged in to book an appointment.');
    }

    // Get the patient record for the currently logged-in user
    $user = auth()->user();
    $patient = Patient::where('users_id', $user->users_id)->first();

    if (!$patient) {
        return redirect()->route('appointments.index')->with('error', 'Patient record not found for this user.');
    }

    Appointment::create([
        'patient_id' => $patient->patient_id,
        'doctor_id' => $request->doctor_id,
        'appointment_date' => $request->appointment_date,
        'appointment_time' => $request->appointment_time,
        'appointment_status' => 'pending'
    ]);

    return redirect()->route('appointments.index')->with('success', 'Appointment booked successfully!');
    }

    public function show($id)
    {
        $appointment = Appointment::with(['doctor.user', 'patient.user'])->findOrFail($id);
        return view('appointments.show', compact('appointment'));
    }

    public function myAppointments()
{
    if (!auth()->check()) {
        return redirect()->route('appointments.index')->with('error', 'You must be logged in to view your appointments.');
    }

    // Get current user's patient record
    $user = auth()->user();
    $patient = Patient::where('users_id', $user->users_id)->first();

    if (!$patient) {
        return redirect()->route('appointments.index')->with('error', 'Patient record not found.');
    }

    $appointments = Appointment::with(['doctor.user'])
        ->where('patient_id', $patient->patient_id)
        ->orderBy('appointment_date', 'desc')
        ->get();

    return view('appointments.my-appointments', compact('appointments'));
}
}