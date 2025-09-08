{{-- filepath: d:\PROJECTS\University\CSE370\caremate\caremate\resources\views\admin\admindashboard.blade.php --}}
@extends('layout')

@section('content')
<div class="container mx-auto p-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Admin Dashboard</h1>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 font-semibold transition">
                Logout
            </button>
        </form>
    </div>
    <p class="mb-4">Welcome, {{ $user->first_name ?? $user->name ?? $user->email }}!</p>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-blue-50 rounded-lg p-6 shadow">
            <div class="text-gray-600">Doctors</div>
            <div class="text-3xl font-bold">{{ $doctorCount }}</div>
        </div>
        <div class="bg-green-50 rounded-lg p-6 shadow">
            <div class="text-gray-600">Patients</div>
            <div class="text-3xl font-bold">{{ $patientCount }}</div>
        </div>
        <div class="bg-yellow-50 rounded-lg p-6 shadow">
            <div class="text-gray-600">Appointments</div>
            <div class="text-3xl font-bold">{{ $appointmentCount }}</div>
        </div>
    </div>

    <h2 class="text-xl font-semibold mb-4">Appointments</h2>
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif
    <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
    <tr>
        <th class="px-4 py-2 text-left text-xs font-bold text-gray-700">ID</th>
        <th class="px-4 py-2 text-left text-xs font-bold text-gray-700">Doctor</th>
        <th class="px-4 py-2 text-left text-xs font-bold text-gray-700">Patient</th>
        <th class="px-4 py-2 text-left text-xs font-bold text-gray-700">Date</th>
        <th class="px-4 py-2 text-left text-xs font-bold text-gray-700">Time</th>
        <th class="px-4 py-2 text-left text-xs font-bold text-gray-700">Status</th>
        <th class="px-4 py-2 text-left text-xs font-bold text-gray-700">Serial No.</th>
        <th class="px-4 py-2 text-left text-xs font-bold text-gray-700">Change Status / Serial</th>
    </tr>
</thead>
<tbody>
    @foreach($appointments as $appt)
        <tr>
            <td class="px-4 py-2">{{ $appt->appointment_id }}</td>
            <td class="px-4 py-2">{{ $appt->doctor_id }}</td>
            <td class="px-4 py-2">{{ $appt->patient_id }}</td>
            <td class="px-4 py-2">{{ $appt->appointment_date }}</td>
            <td class="px-4 py-2">{{ $appt->appointment_time }}</td>
            <td class="px-4 py-2 font-semibold">{{ ucfirst($appt->appointment_status) }}</td>
            <td class="px-4 py-2">{{ $appt->serial_no }}</td>
            <td class="px-4 py-2">
                <form action="{{ route('admin.appointment.status', $appt->appointment_id) }}" method="POST" class="flex items-center space-x-2">
                    @csrf
                    <select name="appointment_status" class="border rounded px-2 py-1 text-xs">
                        @foreach(['pending','confirmed','completed','cancelled'] as $status)
                            <option value="{{ $status }}" @if($appt->appointment_status == $status) selected @endif>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="serial_no" value="{{ $appt->serial_no }}" placeholder="Serial" class="border rounded px-2 py-1 text-xs w-20">
                    <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded text-xs hover:bg-blue-600">Update</button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>
        </table>
    </div>
</div>
@endsection