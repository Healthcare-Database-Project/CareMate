@extends('layout')

@section('content')
<div class="container mx-auto p-8">
<h1 class=" text-4xl">medicine catalogue</h1>
    <div class="grid grid-cols-3 grid-flow-row gap-6 px-6 py-6 items-center font-sans w-full">
        @foreach ($medicines as $medicine)
            <div class="flex items-center bg-white rounded-lg shadow-xl w-full h-24 text-lg text-center">
                {{$medicine['common_name']}}
            </div>
        @endforeach
    </div>
</div>
@endsection