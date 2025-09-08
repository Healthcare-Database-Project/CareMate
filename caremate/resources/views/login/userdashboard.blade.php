
@extends('layout')

@section('content')

<div class="p-6 max-w-7xl mx-auto">
    <!-- Navbar/Header -->
    <nav class="navbar bg-white bg-opacity-95 backdrop-blur shadow fixed w-full top-0 z-50">
        <div class="nav-container max-w-7xl mx-auto flex justify-between items-center px-6 py-3">
            <a href="{{ route('welcome') }}" class="logo text-2xl font-bold text-blue-600">CareMate</a>
            <ul class="nav-links flex gap-8 list-none items-center">
                <li><a href="{{ route('home') }}" class="text-gray-700 font-medium hover:text-blue-600 transition">Medicines</a></li>
                <li><a href="{{ route('appointments.index') }}" class="text-gray-700 font-medium hover:text-blue-600 transition">Book Appointments</a></li>
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
            <h1 class="text-3xl font-bold text-blue-800 mb-1">Welcome, {{ $user->first_name }}!</h1>
            <p class="text-blue-100 text-lg">Here’s your dashboard overview.</p>
        </div>
    </div>


    <!-- User Info Card -->
    <div class="bg-white rounded-xl shadow p-6 mb-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-blue-700 flex items-center gap-2">
                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Your Information
            </h2>
            <a href="{{ route('patient.profile') }}" class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600 transition">
                View/Update Profile
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-2 text-gray-700">
            <div><span class="font-semibold">User ID:</span> {{ $user->users_id }}</div>
            <div><span class="font-semibold">Email:</span> {{ $user->email }}</div>
            <div><span class="font-semibold">Gender:</span> {{ $patient->sex }}</div>
            <div><span class="font-semibold">Role:</span> {{ ucfirst($user->role) }}</div>
        </div>
    </div>

    <!-- Medicine History -->
    <div class="bg-white rounded shadow p-4 mb-6">
        <h2 class="text-xl font-semibold mb-4">Medicine History</h2>
        @if(count($medicineHistory) > 0)
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Medicine Name</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Prescription Start Date</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Prescription End Date</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($medicineHistory as $entry)
                        <tr>
                            <td class="px-4 py-2">{{ $entry->medicine_name }}</td>
                            <td class="px-4 py-2">{{ $entry->prescription_start_date }}</td>
                            <td class="px-4 py-2">{{ $entry->prescription_end_date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-600">No medicine history found.</p>
        @endif
    </div>

    <div class="mb-6">
        <a href="{{ route('medicinecatalogue.tracker') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold shadow hover:bg-blue-700 transition">
            Go to Medicine Tracker
        </a>
    </div>

    <!-- Blood Pressure Tracker -->
    <div class="bg-white rounded shadow p-4 mb-6">
        <h2 class="text-xl font-semibold mb-4">Blood Pressure Tracker</h2>
        <!-- Entry Form -->
        <form method="POST" action="{{ route('patient.bp.log') }}" class="flex flex-col sm:flex-row gap-4 items-center mb-4">
            @csrf
            <input type="date" name="date_of_recording" class="border rounded px-2 py-1" required value="{{ date('Y-m-d') }}">
            <input type="time" name="time_of_recording" class="border rounded px-2 py-1" required value="{{ date('H:i') }}">
            <input type="text" name="blood_pressure" class="border rounded px-2 py-1" placeholder="e.g. 120/80" required>
            <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700 transition">Log BP</button>
        </form>

        <!-- Weekly Report -->
        <h3 class="text-lg font-semibold mb-2">This Week's Blood Pressure</h3>
        @if(count($bpWeek) > 0)
            <table class="min-w-full divide-y divide-gray-200 mb-2">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Time</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Blood Pressure</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($bpWeek as $bp)
                        <tr>
                            <td class="px-4 py-2">{{ $bp->date_of_recording }}</td>
                            <td class="px-4 py-2">{{ $bp->time_of_recording }}</td>
                            <td class="px-4 py-2">{{ $bp->blood_pressure }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-600">No blood pressure entries for this week.</p>
        @endif

        <!-- Monthly Report Link -->
        <a href="{{ route('patient.bp.monthly') }}" class="inline-block mt-2 bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600 transition">
            View Monthly Report
        </a>
    </div>

    <!-- Blood Sugar Tracker -->
    <div class="bg-white rounded shadow p-4 mb-6">
        <h2 class="text-xl font-semibold mb-4">Blood Sugar Tracker</h2>
        <!-- Entry Form -->
        <form method="POST" action="{{ route('patient.bs.log') }}" class="flex flex-col sm:flex-row gap-4 items-center mb-4">
            @csrf
            <input type="date" name="date_of_recording" class="border rounded px-2 py-1" required value="{{ date('Y-m-d') }}">
            <input type="time" name="time_of_recording" class="border rounded px-2 py-1" required value="{{ date('H:i') }}">
            <input type="number" step="0.1" name="blood_sugar" class="border rounded px-2 py-1" placeholder="mg/dL" required>
            <button type="submit" class="bg-purple-600 text-white px-4 py-1 rounded hover:bg-purple-700 transition">Log Sugar</button>
        </form>

        <!-- Weekly Report -->
        <h3 class="text-lg font-semibold mb-2">This Week's Blood Sugar</h3>
        @if(count($bsWeek) > 0)
            <table class="min-w-full divide-y divide-gray-200 mb-2">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Time</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Blood Sugar (mg/dL)</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($bsWeek as $bs)
                        <tr>
                            <td class="px-4 py-2">{{ $bs->date_of_recording }}</td>
                            <td class="px-4 py-2">{{ $bs->time_of_recording }}</td>
                            <td class="px-4 py-2">{{ $bs->blood_sugar_level }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-600">No blood sugar entries for this week.</p>
        @endif

        <!-- Monthly Report Link -->
        <a href="{{ route('patient.bs.monthly') }}" class="inline-block mt-2 bg-purple-500 text-white px-4 py-1 rounded hover:bg-purple-600 transition">
            View Monthly Report
        </a>
    </div>
    <!-- Illness Records -->
    <div class="bg-white rounded shadow p-4 mb-6">
        <h2 class="text-xl font-semibold mb-4">Illness Records</h2>
        <!-- Entry Form -->
        <form method="POST" action="{{ route('patient.illness.log') }}" class="flex flex-col sm:flex-row gap-4 items-center mb-4">
            @csrf
            <input type="date" name="date_of_recording" class="border rounded px-2 py-1" required value="{{ date('Y-m-d') }}">
            <input type="time" name="time_of_recording" class="border rounded px-2 py-1" required value="{{ date('H:i') }}">
            <input type="text" name="illness_name" class="border rounded px-2 py-1" placeholder="Illness Name" required>
            <input type="text" name="illness_type" class="border rounded px-2 py-1" placeholder="Illness Type" required>
            <button type="submit" class="bg-pink-600 text-white px-4 py-1 rounded hover:bg-pink-700 transition">Log Illness</button>
        </form>

        <!-- Medical History Link -->
        <a href="{{ route('patient.medical.history') }}" class="inline-block mt-2 bg-pink-500 text-white px-4 py-1 rounded hover:bg-pink-600 transition">
            View Medical History
        </a>
    </div>
</div>

@endsection