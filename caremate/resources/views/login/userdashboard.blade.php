
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
</div>

@endsection