@extends('layout')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white rounded shadow p-8">
    <h2 class="text-2xl font-bold mb-6 text-purple-700">Monthly Blood Sugar Report</h2>
    <a href="{{ route('userdashboard') }}" class="mb-4 inline-block bg-gray-300 text-gray-800 px-4 py-1 rounded hover:bg-gray-400 transition">
        &larr; Return to Dashboard
    </a>

    @if(isset($avgSugar))
        <div class="mb-4">
            <span class="font-semibold">Average Blood Sugar:</span>
            <span>{{ $avgSugar }} mg/dL</span>
            <span class="ml-4 font-semibold">Status:</span>
            <span
                @if($status == 'High Blood Sugar')
                    class="text-red-600 font-bold"
                @elseif($status == 'Low Blood Sugar')
                    class="text-yellow-600 font-bold"
                @else
                    class="text-green-600 font-bold"
                @endif
            >{{ $status }}</span>
        </div>
    @endif

    @if(count($bsMonth) > 0)
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Time</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Blood Sugar (mg/dL)</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($bsMonth as $bs)
                    <tr>
                        <td class="px-4 py-2">{{ $bs->date_of_recording }}</td>
                        <td class="px-4 py-2">{{ $bs->time_of_recording }}</td>
                        <td class="px-4 py-2">{{ $bs->blood_sugar_level }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-600">No blood sugar entries for this month.</p>
    @endif
</div>
@endsection