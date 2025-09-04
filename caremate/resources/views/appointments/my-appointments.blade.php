@extends('layout')

@section('title', 'My Appointments')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">My Appointments</h1>
            <a href="{{ route('appointments.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">
                Book New Appointment
            </a>
        </div>

        @if($appointments->count() > 0)
            <div class="space-y-4">
                @foreach($appointments as $appointment)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex flex-col md:flex-row md:items-center justify-between">
                            <div class="flex-1">
                                <div class="flex items-center mb-2">
                                    <h3 class="text-xl font-semibold text-gray-800 mr-4">
                                        Dr. {{ $appointment->doctor->name }}
                                    </h3>
                                    <span class="px-3 py-1 rounded-full text-sm font-medium
                                        @if($appointment->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($appointment->status === 'confirmed') bg-green-100 text-green-800
                                        @elseif($appointment->status === 'completed') bg-blue-100 text-blue-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($appointment->status) }}
                                    </span>
                                </div>
                                
                                <p class="text-gray-600 mb-1">
                                    <span class="font-medium">Specialization:</span> {{ $appointment->doctor->specialization }}
                                </p>
                                
                                <p class="text-gray-600 mb-1">
                                    <span class="font-medium">Date & Time:</span> 
                                    {{ $appointment->appointment_date->format('M d, Y') }} at 
                                    {{ date('h:i A', strtotime($appointment->appointment_time)) }}
                                </p>
                                
                                <p class="text-gray-600 mb-1">
                                    <span class="font-medium">Patient:</span> {{ $appointment->patient_name }}
                                </p>
                                
                                @if($appointment->symptoms)
                                    <p class="text-gray-600 mb-1">
                                        <span class="font-medium">Symptoms:</span> {{ $appointment->symptoms }}
                                    </p>
                                @endif
                            </div>
                            
                            <div class="mt-4 md:mt-0 md:ml-6">
                                <div class="text-right">
                                    <p class="text-sm text-gray-500">
                                        Booked on {{ $appointment->created_at->format('M d, Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <div class="mb-4">
                    <svg class="w-16 h-16 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4m-9 4h12l-1 10H8L7 11z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No appointments found</h3>
                <p class="text-gray-500 mb-6">You haven't booked any appointments yet.</p>
                <a href="{{ route('appointments.index') }}" 
                   class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg transition duration-200 inline-block">
                    Book Your First Appointment
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
