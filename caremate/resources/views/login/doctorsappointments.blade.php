@extends('layout')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white rounded shadow p-8">
    <h2 class="text-2xl font-bold mb-6 text-blue-700">Upcoming Appointments</h2>
    @if(count($appointments))
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2">Patient Name</th>
                    <th class="px-4 py-2">Time</th>
                    <th class="px-4 py-2">Day</th>
                    <th class="px-4 py-2">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appt)
                <tr>
                    <td class="px-4 py-2">{{ $appt['patient_name'] }}</td>
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($appt['appointment_time'])->format('H:i') }}</td>
                    <td class="px-4 py-2">{{ $appt['appointment_day'] }}</td>
                    <td class="px-4 py-2">{{ $appt['appointment_date'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No upcoming appointments.</p>
    @endif
    <a href="{{ route('doctordashboard') }}" class="mt-6 inline-block bg-gray-300 text-gray-800 px-4 py-1 rounded hover:bg-gray-400 transition">
        &larr; Return to Dashboard
    </a>
</div>
@endsection