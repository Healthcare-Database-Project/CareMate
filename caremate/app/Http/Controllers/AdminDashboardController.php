<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;

class AdminDashboardController extends BaseController
{
    public function index()
    {
        $user = Auth::user();
        if (!$user || ($user->role ?? null) !== 'admin') {
            return redirect()->route('home');
        }

        $doctorCount = \App\Models\Doctor::count();
        $patientCount = \App\Models\Patient::count();
        $appointmentCount = \App\Models\Appointment::count();

        // Fetch all appointments for the table
        $appointments = Appointment::orderBy('appointment_date', 'desc')->get();

        return view('admin.admindashboard', [
            'user' => $user,
            'doctorCount' => $doctorCount,
            'patientCount' => $patientCount,
            'appointmentCount' => $appointmentCount,
            'appointments' => $appointments,
        ]);
    }

    public function updateAppointmentStatus(Request $request, $id)
    {
        $request->validate([
            'appointment_status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $appointment = Appointment::findOrFail($id);
        $appointment->appointment_status = $request->appointment_status;
        $appointment->save();

        return redirect()->route('admindashboard')->with('success', 'Appointment status updated.');
    }
}