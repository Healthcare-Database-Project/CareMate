<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class SignupController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'required|string|min:6',
            'account_type' => 'required|in:patient,doctor,admin',
        ]);

        // Create user
        $user = User::create([
            'name'        => $validated['name'],
            'email'       => $validated['email'],
            'password'    => Hash::make($validated['password']),
            'phone_number'=> '01700000000', // You can add phone, gender, birth_date fields to the form if needed
            'gender'      => 'Female',
            'birth_date'  => '2002-01-01',
        ]);

        // Add to role-specific table
        if ($validated['account_type'] === 'patient') {
            DB::table('patients')->insert(['patient_id' => $user->user_id]);
        } elseif ($validated['account_type'] === 'doctor') {
            DB::table('doctors')->insert(['doctor_id' => $user->user_id, 'specialization' => '']);
        } elseif ($validated['account_type'] === 'admin') {
            DB::table('admins')->insert(['admin_id' => $user->user_id]);
        }

        return redirect()->route('login')->with('success', 'Account created! Please login.');
    }

    
}