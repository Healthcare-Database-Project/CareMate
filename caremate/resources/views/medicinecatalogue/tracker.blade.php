@extends('layout')

@section('content')
<div class="container mx-auto p-8">
    <h1 class="text-center text-4xl">Medicine Tracker</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 px-6 py-6">
        @foreach ($medicines as $medicine)
            <div class="bg-white rounded-lg shadow-xl p-4 flex flex-col justify-between min-h-[10rem]">
                <div>
                    <h2 class="text-lg font-bold text-gray-800 break-words">{{ $medicine->common_name }}</h2>
                    <p class="text-sm text-gray-500 italic break-words">{{ $medicine->generic_name }}</p>
                </div>
                <div class="mt-2">
                    <p class="text-sm text-gray-600">Type: {{ $medicine->med_type }}</p>
                    <p class="text-sm text-gray-600">Dosage: {{ $medicine->dosage }}</p>
                </div>
                <div class="mt-3 flex justify-between items-center" x-data="{ showModal: false }">
                    <button 
                        type="button"
                        @click="showModal = true"
                        class="bg-green-500 hover:bg-green-600 text-white text-sm px-3 py-1 rounded-xl shadow"
                    >
                        Add to Tracker
                    </button>
                    <div 
                        x-show="showModal"
                        style="display: none;"
                        class="fixed inset-0 flex items-center justify-center backdrop-blur z-50"
                    >
                        <div class="bg-white p-6 rounded-lg shadow-lg w-80" @click.away="showModal = false">
                            <h3 class="text-lg font-semibold mb-4">Add to Tracker</h3>
                            <form 
                                action="{{ route('medicinecatalogue.addToTracker') }}" 
                                method="POST"
                                @submit="showModal = false"
                            >
                                @csrf
                                <input type="hidden" name="medicine_id" value="{{ $medicine->medicine_id }}">
                                <div class="mb-3">
                                    <label class="block text-sm font-medium mb-1" for="date_of_recording_{{ $medicine->medicine_id }}">Date of Recording</label>
                                    <input 
                                        type="date" 
                                        name="date_of_recording" 
                                        id="date_of_recording_{{ $medicine->medicine_id }}"
                                        class="border rounded px-2 py-1 w-full"
                                        required
                                    >
                                </div>
                                <div class="mb-3">
                                    <label class="block text-sm font-medium mb-1" for="prescription_start_{{ $medicine->medicine_id }}">Prescription Start Date</label>
                                    <input 
                                        type="date" 
                                        name="prescription_start_date" 
                                        id="prescription_start_{{ $medicine->medicine_id }}"
                                        class="border rounded px-2 py-1 w-full"
                                        required
                                    >
                                </div>
                                <div class="mb-3">
                                    <label class="block text-sm font-medium mb-1" for="prescription_end_{{ $medicine->medicine_id }}">Prescription End Date</label>
                                    <input 
                                        type="date" 
                                        name="prescription_end_date" 
                                        id="prescription_end_{{ $medicine->medicine_id }}"
                                        class="border rounded px-2 py-1 w-full"
                                        required
                                    >
                                </div>
                                <div class="flex justify-end space-x-2">
                                    <button 
                                        type="button" 
                                        @click="showModal = false"
                                        class="px-3 py-1 rounded bg-gray-300 hover:bg-gray-400"
                                    >Cancel</button>
                                    <button 
                                        type="submit"
                                        class="px-3 py-1 rounded bg-green-500 text-white hover:bg-green-600"
                                    >Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection