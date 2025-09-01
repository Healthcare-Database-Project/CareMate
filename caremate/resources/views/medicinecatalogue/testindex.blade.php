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
                <div class="mt-3 flex justify-between items-center">
                    <p class="text-blue-600 font-semibold">Price: ৳{{ number_format($medicine->price, 2) }} / unit</p>
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="medicine_id" value="{{ $medicine->medicine_id }}">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-3 py-1 rounded-xl shadow">
                            Add to Cart
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection