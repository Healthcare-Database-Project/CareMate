@extends('layouts.app')

@section('content')

<div class="p-6 max-w-7xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Welcome, {{ $user->name }}</h1>
    
    <!-- User Info -->
    <div class="bg-white rounded shadow p-4 mb-6">
        <h2 class="text-xl font-semibold mb-2">Your Information</h2>
        <p>Email: {{ $user->email }}</p>
        <p>Phone: {{ $user->phone_no }}</p>
        <p>Gender: {{ $user->gender }}</p>
        <p>Birth Date: {{ $user->birth_date }}</p>
    </div>
    
    <!-- Appointments -->
    <div class="bg-white rounded shadow p-4 mb-6">
        <h2 class="text-xl font-semibold mb-2">Upcoming Appointments</h2>
        <ul>
            @foreach($user->appointments as $appointment)
                <li class="border-b py-2">
                    Dr. {{ $appointment->doctor->name }} on {{ $appointment->appointment_date }}
                    <button class="bg-blue-500 text-white rounded px-2 py-1 ml-4">Cancel</button>
                </li>
            @endforeach
        </ul>
    </div>
    
    <!-- Health Info -->
    <div class="bg-white rounded shadow p-4 mb-6">
        <h2 class="text-xl font-semibold mb-2">Recent Health Info</h2>
        @foreach($user->patient->healthInfos as $info)
            <div class="mb-2">
                <p>Date: {{ $info->date_of_recording }} - Blood Sugar: {{ $info->bloodSugarLevel->blood_sugar_level }} - BP: {{ $info->bloodPressure->blood_pressure }}</p>
            </div>
        @endforeach
    </div>
</div>

@endsection