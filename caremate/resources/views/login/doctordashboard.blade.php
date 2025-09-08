@extends('layout')

@section('content')

<!-- Navbar/Header -->
<nav class="navbar bg-white bg-opacity-95 backdrop-blur shadow fixed w-full top-0 z-50">
    <div class="nav-container max-w-7xl mx-auto flex justify-between items-center px-6 py-3">
        <a href="#" class="logo text-2xl font-bold text-blue-600">CareMate</a>
        <ul class="nav-links flex gap-8 list-none items-center">
            <li><a href="{{ route('home') }}" class="text-gray-700 font-medium hover:text-blue-600 transition">Medicines</a></li>
            <li><a href="{{ route('appointments.index') }}" class="text-gray-700 font-medium hover:text-blue-600 transition">Appointments</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-blue-200 text-gray-500 px-4 py-1 rounded hover:bg-blue-500 transition">
                        Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>
<div class="h-20"></div> <!-- Spacer for fixed navbar -->

<!-- Welcome Card -->
<div class="bg-gradient-to-r from-blue-500 to-blue-700 rounded-xl shadow-lg p-8 mb-8 flex items-center gap-6">
    <div class="flex-shrink-0">
        <svg class="w-16 h-16 text-white bg-blue-400 rounded-full p-3 shadow" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
    </div>
    <div>
        <h1 class="text-3xl font-bold text-blue-100 mb-1">Welcome, Dr. {{ $user->first_name }} {{ $user->last_name }}!</h1>
        <p class="text-blue-100 text-lg">Here’s your doctor dashboard overview.</p>
    </div>
</div>

<!-- Doctor Info Card -->
<div class="bg-white rounded-xl shadow p-6 mb-8">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-blue-700 flex items-center gap-2">
            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Your Information
        </h2>
        <a href="{{ route('doctor.profile') }}" class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600 transition">
            View/Update Profile
        </a>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-2 text-gray-700">
        <div><span class="font-semibold">Doctor ID:</span> {{ $doctor->doctor_id }}</div>
        <div><span class="font-semibold">Email:</span> {{ $user->email }}</div>
        <div><span class="font-semibold">Phone:</span> {{ $doctor->phone }}</div>
        <div><span class="font-semibold">Specialization:</span> {{ $doctor->specialization }}</div>

    </div>
</div>

<!-- Doctor Schedule -->
<div class="bg-white rounded shadow p-4 mb-6">
    <h2 class="text-xl font-semibold mb-4 text-blue-700">Your Schedule</h2>
    @if(count($schedule) > 0)
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Day</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Start Time</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">End Time</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Max Appointments</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($schedule as $slot)
                    <tr>
                        <td class="px-4 py-2">{{ $slot->day_of_week }}</td>
                        <td class="px-4 py-2">{{ $slot->start_time }}</td>
                        <td class="px-4 py-2">{{ $slot->end_time }}</td>
                        <td class="px-4 py-2">{{ $slot->max_appointments }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-600">No schedule found.</p>
    @endif
</div>


@endsection