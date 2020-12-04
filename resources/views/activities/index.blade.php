@extends('layouts.app')

@section('content')
@include('includes.validation')

<ul class="flex-container pl-5 pr-5">
    <li class="row justify-content-center">
    @foreach($activities as $activity)
    <div class="flex-item">
        <h1>{{$activity->title}}</h1>
        <p>{{$activity->description}}</p>
        <h5>Date : {{$activity->date}}</h5>
        <h5>Location : {{$activity->location}}</h5>
        @if(!is_null($activity->image))
            <img width="100em" height="100em" src="{{ $activity->image->src }}" />
        @endif
    </div>

    @endforeach
    </li>
</ul>
@endsection