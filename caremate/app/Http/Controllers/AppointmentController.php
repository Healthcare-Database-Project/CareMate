<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $doctors = User::doctors()->get();
        return view('appointments.index', compact('doctors'));
    }

    public function create()
    {
        $doctors = User::doctors()->get();
        return view('appointments.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,user_id',
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => 'required',
            'patient_name' => 'required|string|max:255',
            'patient_phone' => 'required|string|max:20',
            'patient_email' => 'required|email|max:255',
            'symptoms' => 'nullable|string'
        ]);

        Appointment::create([
            'user_id' => auth()->id(),
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'patient_name' => $request->patient_name,
            'patient_phone' => $request->patient_phone,
            'patient_email' => $request->patient_email,
            'symptoms' => $request->symptoms,
            'status' => 'pending'
        ]);

        return redirect()->route('appointments.index')->with('success', 'Appointment booked successfully!');
    }

    public function show($id)
    {
        $appointment = Appointment::with('doctor')->findOrFail($id);
        return view('appointments.show', compact('appointment'));
    }

    public function myAppointments()
    {
        $appointments = Appointment::with('doctor')
            ->where('user_id', auth()->id())
            ->orderBy('appointment_date', 'desc')
            ->get();
        
        return view('appointments.my-appointments', compact('appointments'));
    }
}
