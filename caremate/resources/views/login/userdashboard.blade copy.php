@extends('layout')

@section('content')

<div class="p-6 max-w-7xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Welcome, {{ $user->first_name }}</h1>
    
    <div class="mb-6">
    <a href="{{ route('medicinecatalogue.tracker') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold shadow hover:bg-blue-700 transition">
        Go to Medicine Tracker
    </a>
    </div>

    <!-- User Info -->
    <div class="bg-white rounded shadow p-4 mb-6">
        <h2 class="text-xl font-semibold mb-2">Your Information</h2>
        <p>ID: {{ $user->users_id }}</p>
        <p>Email: {{ $user->email }}</p>
        <p>Gender: {{ $user->gender }}</p>
        <p>Role: {{ $user->role }}</p>
    </div>
      
</div>

@endsection