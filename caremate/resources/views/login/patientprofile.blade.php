@extends('layout')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white rounded shadow p-8">
    <h2 class="text-2xl font-bold mb-6 text-blue-700">Patient Profile</h2>
    @if(session('success'))
        <div class="mb-4 p-2 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
    @endif
    <form method="POST" action="{{ route('patient.profile.update') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">First Name</label>
            <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Last Name</label>
            <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Gender</label>
            <select name="gender" class="w-full border rounded px-3 py-2" required>
                <option value="Male" {{ ($patient->sex ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ ($patient->sex ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                <option value="Other" {{ ($patient->sex ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $patient->phone ?? '') }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Address</label>
            <input type="text" name="address" value="{{ old('address', $patient->address ?? '') }}" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Blood Group</label>
            <input type="text" name="blood_group" value="{{ old('blood_group', $patient->blood_group ?? '') }}" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Emergency Contact</label>
            <input type="text" name="emergency_contact" value="{{ old('emergency_contact', $patient->emergency_contact ?? '') }}" class="w-full border rounded px-3 py-2">
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Update Profile</button>
        </div>
    </form>
</div>
@endsection