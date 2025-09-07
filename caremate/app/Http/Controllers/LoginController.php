<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Check if user is a doctor
            $isDoctor = DB::table('doctors')->where('doctor_id', $user->user_id)->exists();
            $isPatient = DB::table('patients')->where('patient_id', $user->user_id)->exists();
            $isAdmin = DB::table('admins')->where('admin_id', $user->user_id)->exists();
 
             // Redirect based on role

            if ($isDoctor) {
                return redirect()->route('doctordashboard');
            } else if ($isPatient) {
                return redirect()->route('userdashboard');
            } else if ($isAdmin) {
                return redirect()->route('admindashboard');
            } else {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'No associated role found. Please contact support.',
                ])->onlyInput('email');
            }
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    //
}
