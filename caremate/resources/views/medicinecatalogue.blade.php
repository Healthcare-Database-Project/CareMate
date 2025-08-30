@extends('layout')

@section('content')
<h1>medicine catalogue</h1>
<div class="grid !grid-cols-3 grid-flow-col gap-4">
    @for ($i=0; $i < 50;$i++)
    <div class="bg-white rounded-lg shadow-xl">
        tent
    </div>
    @endfor
</div>
@endsection