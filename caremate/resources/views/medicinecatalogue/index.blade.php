@extends('layout')

@section('content')
<div class="container mx-auto p-8">
    <h1 class="text-center text-4xl">Medicine Catalogue</h1>
    @include('partials._search')
    {{-- {{ print_r(session()->get('cart'))}} --}}
    @if(session()->has('cart'))
        <a href="{{ route('cart.index') }}" class="inline-flex items-center gap-2 mb-2 ml-4 px-4 py-2 rounded-lg bg-blue-50 hover:bg-blue-100 transition text-blue-700 font-semibold shadow-sm">
            <svg class="h-5 w-5" aria-hidden="true" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
            <span>Cart</span>
            <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-blue-600 rounded-full">
                {{ count(session()->get('cart')) }}
            </span>
        </a>
        
    @else
        <a href="{{ route('cart.index') }}" class="inline-flex items-center gap-2 mb-2 ml-4 px-4 py-2 rounded-lg bg-blue-50 hover:bg-blue-100 transition text-blue-700 font-semibold shadow-sm">
            <svg class="h-5 w-5" aria-hidden="true" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
            <span>Cart</span>
            <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-blue-600 rounded-full">
                0
            </span>
        </a>
    @endif
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 grid-flow-row gap-6 px-6 py-6 items-center font-sans w-full">
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
                    <p class="text-blue-600 font-semibold">Price: ৳{{ number_format($medicine->price, 2) }} / unit</p>
 
                    <button 
                        type="button"
                        @click="showModal = true"
                        class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-3 py-1 rounded-xl shadow"
                    >
                        Add to Cart
                    </button>

                    <div 
                        x-show="showModal"
                        style="display: none;"
                        class="fixed inset-0 flex items-center justify-center backdrop-blur z-50"
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
@endsection