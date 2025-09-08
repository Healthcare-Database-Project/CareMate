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
        $appointments = \App\Models\Appointment::orderBy('appointment_date', 'desc')->get();

        return view('admin.admindashboard', compact(
            'user',
            'doctorCount',
            'patientCount',
            'appointmentCount',
            'appointments'
        ));
    }

    public function updateAppointmentStatus(Request $request, $id)
    {
        $request->validate([
            'appointment_status' => 'required|in:pending,confirmed,completed,cancelled',
            'serial_no' => 'nullable|string|max:255'
        ]);

        $appointment = Appointment::findOrFail($id);

        // Find admin id from admin table where users_id matches current user's id
        $admin = \App\Models\Admin::where('users_id', Auth::user()->users_id ?? Auth::user()->id)->first();

        $appointment->appointment_status = $request->appointment_status;
        $appointment->serial_no = $request->serial_no;
        $appointment->admin_id = $admin ? $admin->admin_id : null;
        $appointment->save();

        return redirect()->route('admindashboard')->with('success', 'Appointment updated.');
    }
}
