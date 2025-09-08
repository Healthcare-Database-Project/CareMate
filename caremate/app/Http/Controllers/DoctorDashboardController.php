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
}
