@extends('layout')

@section('title', 'Doctor Appointments')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Book an Appointment</h1>
            <a href="{{ route('appointments.my') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">
                My Appointments
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($doctors as $doctor)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800">{{ $doctor->name }}</h3>
                                <p class="text-gray-600">{{ $doctor->specialization }}</p>
                            </div>
                        </div>
                        
                        <div class="space-y-2 mb-4">
                            <p class="text-sm text-gray-600">
                                <span class="font-medium">Experience:</span> {{ $doctor->experience_years }} years
                            </p>
                            <p class="text-sm text-gray-600">
                                <span class="font-medium">Phone:</span> {{ $doctor->phone_number }}
                            </p>
                            <p class="text-sm text-gray-600">
                                <span class="font-medium">Email:</span> {{ $doctor->email }}
                            </p>
                            <p class="text-sm text-gray-600">
                                <span class="font-medium">Location:</span> {{ $doctor->location }}
                            </p>
                            <p class="text-sm text-gray-600">
                                <span class="font-medium">Fee:</span> ৳{{ $doctor->consultation_fee }}
                            </p>
                        </div>

                        <a href="{{ route('appointments.create') }}?doctor_id={{ $doctor->user_id }}" 
                           class="w-full bg-blue-500 hover:bg-blue-600 text-white text-center py-2 px-4 rounded-lg transition duration-200 inline-block">
                            Book Appointment
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-8">
                    <p class="text-gray-500 text-lg">No doctors available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
