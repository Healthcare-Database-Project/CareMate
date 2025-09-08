@extends('layout')

@section('content')

<!-- Navbar/Header -->
<nav class="navbar bg-white bg-opacity-95 backdrop-blur shadow fixed w-full top-0 z-50">
    <div class="nav-container max-w-7xl mx-auto flex justify-between items-center px-6 py-3">
        <a href="{{ route('welcome') }}" class="logo text-2xl font-bold text-blue-600">CareMate</a>
        <ul class="nav-links flex gap-8 list-none items-center">
            <li><a href="{{ route('home') }}" class="text-gray-700 font-medium hover:text-blue-600 transition">Medicines</a></li>
            <li><a href="{{ route('doctor.appointments') }}" class="text-gray-700 font-medium hover:text-blue-600 transition">My Appointments</a></li>
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
    @php
        $grouped = $schedule->groupBy('day_of_week');
        $days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
    @endphp

    <div class="bg-white rounded shadow p-4 mb-6">
        <h2 class="text-xl font-semibold mb-4 text-blue-700">Your Schedule</h2>
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Day</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Time Slots</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($days as $day)
                    <tr>
                        <td class="px-4 py-2 font-semibold">{{ $day }}</td>
                        <td class="px-4 py-2">
                            @if(isset($grouped[$day]) && count($grouped[$day]))
                                @foreach($grouped[$day] as $slot)
                                    <div class="flex items-center gap-2 mb-1">
                                        <span>
                                            {{ $slot->start_time }} - {{ $slot->end_time }}
                                            (Max: {{ $slot->max_appointments }})
                                        </span>
                                        <form method="POST" action="{{ route('doctor.schedule.delete', $slot->schedule_id) }}" onsubmit="return confirm('Remove this schedule entry?');">
                                            @csrf
                                            <button type="submit" class="text-red-600 hover:text-red-800" title="Remove">
                                                &times;
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            @else
                                <span class="text-gray-400">No schedule</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if(session('success'))
        <div class="mb-4 p-2 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
    @endif

    <!-- Add Schedule Form -->
    <div class="bg-white rounded shadow p-4 mb-6">
        <h3 class="text-lg font-semibold mb-2 text-blue-700">Add Working Hours</h3>
        <form method="POST" action="{{ route('doctor.schedule.add') }}" class="flex flex-col sm:flex-row gap-4 items-center">
            @csrf
            <select name="day_of_week" class="border rounded px-2 py-1" required>
                <option value="">Day</option>
                @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
                    <option value="{{ $day }}">{{ $day }}</option>
                @endforeach
            </select>
            <input type="time" name="start_time" class="border rounded px-2 py-1" required>
            <input type="time" name="end_time" class="border rounded px-2 py-1" required>
            <input type="number" name="max_appointments" class="border rounded px-2 py-1" min="1" placeholder="Max Appointments" required>
            <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700 transition">Add</button>
        </form>
    </div>

    <div class="max-w-7xl mx-auto mb-8 ml-2 pl-6">
        <a href="{{ route('doctor.patients') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            View My Patients
        </a>
    </div>
</div>


@endsection