
@extends('layout')

@section('content')

<div class="p-6 max-w-7xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Welcome, {{ $user->first_name }}</h1>
    
    <div class="mb-6">
        <a href="{{ route('medicinecatalogue.tracker') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold shadow hover:bg-blue-700 transition">
            Go to Medicine Tracker
        </a>
    </div>

    <!-- User Info -->
    <div class="bg-white rounded shadow p-4 mb-6">
        <h2 class="text-xl font-semibold mb-2">Your Information</h2>
        <p>ID: {{ $user->users_id }}</p>
        <p>Email: {{ $user->email }}</p>
        <p>Gender: {{ $user->gender }}</p>
        <p>Role: {{ $user->role }}</p>

        <!-- user profile -->
        <a href="{{ route('patient.profile') }}" class="inline-block mt-2 bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600 transition">
            View/Update Profile
        </a>

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
        <a href="{{ route('patient.bp.monthly') }}" class="inline-block mt-2 bg-green-500 text-white px-4 py-1 rounded hover:bg-green-600 transition">
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
                            <td class="px-4 py-2">{{ $bs->blood_sugar }}</td>
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
</div>

@endsection