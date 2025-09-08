@extends('layout')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white rounded shadow p-8">
    <h2 class="text-2xl font-bold mb-6 text-blue-700">Doctor Profile</h2>
    <a href="{{ route('doctordashboard') }}" class="mb-4 inline-block bg-gray-300 text-gray-800 px-4 py-1 rounded hover:bg-gray-400 transition">
        &larr; Return to Dashboard
    </a>
    @if(session('success'))
        <div class="mb-4 p-2 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
    @endif
    <form method="POST" action="{{ route('doctor.profile.update') }}">
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
            <label class="block text-sm font-medium mb-1">Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $doctor->phone ?? '') }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">BMDC Registration No.</label>
            <input type="text" name="bmdc_reg_no" value="{{ old('bmdc_reg_no', $doctor->bmdc_reg_no ?? '') }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Specialization</label>
            <input type="text" name="specialization" value="{{ old('specialization', $doctor->specialization ?? '') }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Education</label>
            <input type="text" name="education" value="{{ old('education', $doctor->education ?? '') }}" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Years of Experience</label>
            <input type="number" name="years_of_experience" value="{{ old('years_of_experience', $doctor->years_of_experience ?? '') }}" class="w-full border rounded px-3 py-2" min="0">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Consultation Fee</label>
            <input type="number" step="0.01" name="consultation_fee" value="{{ old('consultation_fee', $doctor->consultation_fee ?? '') }}" class="w-full border rounded px-3 py-2" min="0">
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Update Profile</button>
        </div>
    </form>
</div>
@endsection