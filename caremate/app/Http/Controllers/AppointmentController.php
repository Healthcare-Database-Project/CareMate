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

        // For now, use the first patient or create a default one
        $patient = Patient::first();
        if (!$patient) {
            // Create a default patient if none exists
            $user = User::create([
                'first_name' => 'Default',
                'last_name' => 'Patient',
                'email' => 'default@patient.com',
                'password' => bcrypt('password123'),
                'role' => 'patient',
            ]);

            $patient = Patient::create([
                'users_id' => $user->users_id,
                'phone' => '+880-1711-000000',
                'age' => 30,
                'sex' => 'Other',
                'address' => 'Default Address',
                'medical_history' => 'No history available',
                'blood_group' => 'Unknown',
                'emergency_contact' => '+880-1711-000001',
            ]);
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
        // For demo purposes, if no user is authenticated, show appointments for the first patient
        if (!auth()->check()) {
            // Get the first patient for demo purposes
            $patient = Patient::first();
            
            if (!$patient) {
                return redirect()->route('appointments.index')->with('error', 'No patient records found. Please create a patient first.');
            }
        } else {
            // Get current user's patient record
            $patient = auth()->user()->patient;
            
            if (!$patient) {
                return redirect()->route('appointments.index')->with('error', 'Patient record not found.');
            }
        }

        $appointments = Appointment::with(['doctor.user'])
            ->where('patient_id', $patient->patient_id)
            ->orderBy('appointment_date', 'desc')
            ->get();
        
        return view('appointments.my-appointments', compact('appointments'));
    }
}
