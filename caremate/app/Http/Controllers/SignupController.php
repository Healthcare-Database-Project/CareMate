<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;

class SignupController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'required|string|min:6',
            'account_type' => 'required|in:patient,doctor,admin',
            'phone_number' => 'required|string|max:20',
            'gender'       => 'required|string|max:10',
        ]);

        // Create user
        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name'  => $validated['last_name'],
            'email'      => $validated['email'],
            'password'   => Hash::make($validated['password']),
            'role'       => $validated['account_type'],
        ]);

        // Add to role-specific table
        if ($validated['account_type'] === 'patient') {
            DB::table('patient')->insert([
                'users_id'          => $user->users_id,
                'phone'             => $validated['phone_number'],
                'age'               => 18, 
                'sex'               => $validated['gender'], 
                'address'           => '', 
                'blood_group'       => '', 
                'emergency_contact' => '',
            ]);

        } elseif ($validated['account_type'] === 'doctor') {
            DB::table('doctor')->insert([
                'users_id' => $user->users_id,
                'bmdc_reg_no' => uniqid('BMDC'), 
                'specialization' => '', 
                'years_of_experience' => 0,
                'consultation_fee' => 0, 
                'education' => '', 
                'phone' => $validated['phone_number'],
            ]);
        } elseif ($validated['account_type'] === 'admin') {
            DB::table('admin')->insert([
                'users_id' => $user->users_id,
                'admin_level' => '', 
                'department' => ''
            ]);
        }

        return redirect()->route('login')->with('success', 'Account created! Please login.');
    }

    
}