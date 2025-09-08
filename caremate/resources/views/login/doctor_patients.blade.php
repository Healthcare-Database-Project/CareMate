@extends('layout')
@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white rounded shadow p-8">
    <h2 class="text-2xl font-bold mb-6 text-blue-700">My Patients</h2>
    <a href="{{ route('doctordashboard') }}" class="mb-4 inline-block bg-gray-300 text-gray-800 px-4 py-1 rounded hover:bg-gray-400 transition">
        &larr; Return to Dashboard
    </a>
    @if(count($patients) > 0)
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Phone</th>
                    <th class="px-4 py-2">Blood Group</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($patients as $p)
                <tr>
                    <td class="px-4 py-2">{{ $p->first_name }} {{ $p->last_name }}</td>
                    <td class="px-4 py-2">{{ $p->email }}</td>
                    <td class="px-4 py-2">{{ $p->phone }}</td>
                    <td class="px-4 py-2">{{ $p->blood_group }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('doctor.patient.details', $p->patient_id) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-700">View Details</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No patients found.</p>
    @endif
</div>
@endsection