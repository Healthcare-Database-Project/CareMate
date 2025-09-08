@extends('layout')

@section('content')
<div class="container mx-auto py-8 px-4">
    <nav class="mb-6 flex justify-between">
        <a href="{{ url('/') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 font-semibold transition">
            Home
        </a>
        <a href="{{ route('home') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 font-semibold transition">
            Back to Catalogue
        </a>
    </nav>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold px-2 ">Medicine Cart</h1>
        @if(count($cart) > 0)
        <form action="{{ route('cart.clear') }}" method="POST">
            @csrf
            <button type="submit" class="bg-white text-red-700 border-2 border-red-700 px-4 py-2 rounded-lg hover:bg-red-700 hover:text-white font-semibold transition">
                                        Clear Cart
                                    </button>
        </form>
        @endif
    </div>
    @php
        $cart = session('cart', []);
    @endphp

    @if(count($cart) > 0)
        <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-base font-bold text-white uppercase tracking-wider">Medicine Name</th>
                        <th class="px-6 py-3 text-center text-base font-bold text-white uppercase tracking-wider">Quantity</th>
                        <th class="px-6 py-3 text-right text-base font-bold text-white uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-right text-base font-bold text-white uppercase tracking-wider">Subtotal</th>
                        <th class="px-6 py-3 text-center text-base font-bold text-white uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($cart as $medicine)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-800 font-semibold">
                                {{ $medicine['common_name'] }}
                            </td>
                            <td class="px-6 py-4 text-center text-gray-700">
                                <div class="flex items-center justify-center space-x-2">
                                    <form action="{{ route('cart.update', $medicine['id']) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="action" value="decrement">
                                        <button type="submit" class="px-2 py-0 bg-indigo-200 rounded hover:bg-indigo-300 font-bold text-lg">−</button>
                                    </form>
                                    <span class="mx-2 mr-2.5 text-bold text-lg">{{ $medicine['qty'] }}</span>
                                    <form action="{{ route('cart.update', $medicine['id']) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="action" value="increment">
                                        <button type="submit" class="px-2 py-0 bg-indigo-200 rounded hover:bg-indigo-300 font-bold text-lg">+</button>
                                    </form>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right text-gray-700">
                                ৳{{ number_format($medicine['price'], 2) }}
                            </td>
                            <td class="px-6 py-4 text-right text-gray-700 font-bold">
                                ৳{{ number_format($medicine['price'] * $medicine['qty'], 2) }}
                            </td>

                            <td class="px-6 py-4 text-center">
    <div x-data="{ open: false }" class="inline-block">
        <button 
            type="button"
            @click="open = true"
            class="bg-white text-red-700 border-2 border-red-700 px-3 py-1 rounded hover:bg-red-700 hover:text-white font-semibold"
        >
            Delete
        </button>
        <!-- Confirmation Modal -->
        <div 
            x-show="open"
            x-cloak
            class="fixed inset-0 flex items-center justify-center backdrop-blur z-50"
        >
            <div class="bg-white rounded-lg shadow-lg p-6 w-80" @click.away="open = false">
                <h2 class="text-lg font-bold mb-4 text-red-700">Remove Item</h2>
                <p class="mb-6 text-gray-700">Are you sure you want to remove this item from your cart?</p>
                <div class="flex justify-end space-x-2">
                    <button 
                        type="button"
                        @click="open = false"
                        class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 text-gray-700"
                    >Cancel</button>
                    <form action="{{ route('cart.delete', $medicine['id']) }}" method="POST" class="inline">
                        @csrf
                        <button 
                            type="submit"
                            class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700 font-semibold"
                        >Delete</button>
                    </form>
                        </div>
                    </div>
                </div>
            </div>
        </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="border-t-1 border-gray-500">
                        <th colspan="3" class="px-6 py-4 text-right text-gray-900 text-lg font-bold">Total:</th>
                        <th class="px-6 py-4 text-right text-gray-900 text-lg font-bold">৳{{ number_format(session()->get('cartItemsTotal'), 2) }}</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    @else
        <div class="bg-blue-50 border border-blue-200 text-blue-700 px-6 py-4 rounded-lg shadow text-center mt-8 font-bold">
            Your cart is empty.
        </div>
    @endif
</div>
@endsection