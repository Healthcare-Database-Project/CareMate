
@extends('layout')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white rounded shadow p-8">
    <h2 class="text-2xl font-bold mb-6 text-pink-700">Medical History</h2>
    <a href="{{ route('userdashboard') }}" class="mb-4 inline-block bg-gray-300 text-gray-800 px-4 py-1 rounded hover:bg-gray-400 transition">
        &larr; Return to Dashboard
    </a>
    @if(count($illnesses) > 0)
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Time</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Illness Name</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Illness Type</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($illnesses as $illness)
                    <tr>
                        <td class="px-4 py-2">{{ $illness->date_of_recording }}</td>
                        <td class="px-4 py-2">{{ $illness->time_of_recording }}</td>
                        <td class="px-4 py-2">{{ $illness->illness_name }}</td>
                        <td class="px-4 py-2">{{ $illness->illness_type }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-600">No illness records found.</p>
    @endif
</div>
@endsection