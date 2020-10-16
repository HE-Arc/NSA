@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach($associations as $association)
            <div>
                {{ $association }}
            </div>
        @endforeach
    </div>
</div>
@endsection