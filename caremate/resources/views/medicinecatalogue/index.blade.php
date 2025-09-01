@extends('layout')

@section('content')
<div class="container mx-auto p-8">
    <h1 class="text-center text-4xl">Medicine Catalogue</h1>
    @include('partials._search')
    {{ print_r(session()->get('cart'))}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 grid-flow-row gap-6 px-6 py-6 items-center font-sans w-full">
        @foreach ($medicines as $medicine)
            <div class="bg-white rounded-lg shadow-xl p-4 flex flex-col justify-between min-h-[10rem]">
                <!-- Top: Common & Generic Name -->
                <div>
                    <h2 class="text-lg font-bold text-gray-800 break-words">{{ $medicine->common_name }}</h2>
                    <p class="text-sm text-gray-500 italic break-words">{{ $medicine->generic_name }}</p>
                </div>

                <!-- Middle: Type & Dosage -->
                <div class="mt-2">
                    <p class="text-sm text-gray-600">Type: {{ $medicine->med_type }}</p>
                    <p class="text-sm text-gray-600">Dosage: {{ $medicine->dosage }}</p>
                </div>

                <!-- Bottom: Price -->
                <div class="mt-3 flex justify-between items-center" x-data="{ showModal: false }">
                    <p class="text-blue-600 font-semibold">Price: ৳{{ number_format($medicine->price, 2) }} / unit</p>
                    <!-- Trigger Button -->
                    <button 
                        type="button"
                        @click="showModal = true"
                        class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-3 py-1 rounded-xl shadow"
                    >
                        Add to Cart
                    </button>
                    <!-- Modal -->
                    <div 
                        x-show="showModal"
                        style="display: none;"
                        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
                    >
                        <div class="bg-white p-6 rounded-lg shadow-lg w-80" @click.away="showModal = false">
                            <h3 class="text-lg font-semibold mb-4">Add to Cart</h3>
                            <form 
                                action="/cart/add" 
                                method="POST"
                                @submit="showModal = false"
                            >
                                @csrf
                                <input type="hidden" name="medicine_id" value="{{ $medicine->medicine_id }}">
                                <div class="mb-3">
                                    <label class="block text-sm font-medium mb-1" for="pills_per_day_{{ $medicine->medicine_id }}">Pills per day</label>
                                    <input 
                                        type="number" 
                                        min="1" 
                                        name="pills_per_day" 
                                        id="pills_per_day_{{ $medicine->medicine_id }}"
                                        class="border rounded px-2 py-1 w-full"
                                        required
                                    >
                                </div>
                                <div class="mb-3">
                                    <label class="block text-sm font-medium mb-1" for="days_{{ $medicine->medicine_id }}">Number of days</label>
                                    <input 
                                        type="number" 
                                        min="1" 
                                        name="days" 
                                        id="days_{{ $medicine->medicine_id }}"
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
                                        class="px-3 py-1 rounded bg-blue-500 text-white hover:bg-blue-600"
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
<!-- Alpine.js CDN (if not already included) -->
<script src="//unpkg.com/alpinejs" defer></script>
@endsection