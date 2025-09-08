@extends('layout')
@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white rounded shadow p-8">
    <h2 class="text-2xl font-bold mb-6 text-blue-700">Patient: {{ $patient->first_name }} {{ $patient->last_name }}</h2>
    <a href="{{ route('doctor.patients') }}" class="mb-4 inline-block bg-gray-300 text-gray-800 px-4 py-1 rounded hover:bg-gray-400 transition">
        &larr; Return
    </a>
    <div class="mb-4">
        <strong>Email:</strong> {{ $patient->email }}<br>
        <strong>Phone:</strong> {{ $patient->phone }}<br>
        <strong>Blood Group:</strong> {{ $patient->blood_group }}<br>
        <strong>Gender:</strong> {{ $patient->sex }}
    </div>
    <h3 class="text-xl font-semibold mt-6 mb-2 text-blue-600">Monthly Blood Pressure</h3>
    @if(count($bpMonth))
        <table class="min-w-full divide-y divide-gray-200 mb-4">
            <thead>
                <tr>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Time</th>
                    <th class="px-4 py-2">Blood Pressure</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bpMonth as $bp)
                <tr>
                    <td class="px-4 py-2">{{ $bp->date_of_recording }}</td>
                    <td class="px-4 py-2">{{ $bp->time_of_recording }}</td>
                    <td class="px-4 py-2">{{ $bp->blood_pressure }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No blood pressure records for this month.</p>
    @endif

    <h3 class="text-xl font-semibold mt-6 mb-2 text-purple-600">Monthly Blood Sugar</h3>
    @if(count($bsMonth))
        <table class="min-w-full divide-y divide-gray-200 mb-4">
            <thead>
                <tr>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Time</th>
                    <th class="px-4 py-2">Blood Sugar (mg/dL)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bsMonth as $bs)
                <tr>
                    <td class="px-4 py-2">{{ $bs->date_of_recording }}</td>
                    <td class="px-4 py-2">{{ $bs->time_of_recording }}</td>
                    <td class="px-4 py-2">{{ $bs->blood_sugar_level }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No blood sugar records for this month.</p>
    @endif

    <h3 class="text-xl font-semibold mt-6 mb-2 text-pink-600">Medical History</h3>
    @if(count($illnesses))
        <table class="min-w-full divide-y divide-gray-200 mb-4">
            <thead>
                <tr>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Time</th>
                    <th class="px-4 py-2">Illness Name</th>
                    <th class="px-4 py-2">Illness Type</th>
                </tr>
            </thead>
            <tbody>
                @foreach($illnesses as $illness)
                <tr>
                    <td class="px-4 py-2">{{ $illness->date_of_recording }}</td>
                    <td class="px-4 py-2">{{ $illness->time_of_recording }}</td>
                    <td class="px-4 py-2">{{ $illness->illness_name }}</td>
                    <td class="px-4 py-2">{{ $illness->illness_type }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No illness records found.</p>
    @endif

    <h3 class="text-xl font-semibold mt-6 mb-2 text-green-600">Medicine History</h3>
    @if(count($medicineHistory))
        <table class="min-w-full divide-y divide-gray-200 mb-4">
            <thead>
                <tr>
                    <th class="px-4 py-2">Medicine Name</th>
                    <th class="px-4 py-2">Prescription Start</th>
                    <th class="px-4 py-2">Prescription End</th>
                </tr>
            </thead>
            <tbody>
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
        <p>No medicine history found.</p>
    @endif
</div>
@endsection