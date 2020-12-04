@extends('layouts.app')

@section('content')

@include('includes.validation')

<div class="flex-container">
    @if(isset($activity))
        <h1>{{$activity->title}}</h1>
        <p>{{$activity->description}}</p>

        <h5>Date : {{$activity->date}}</h5>
        <h5>Location : {{$activity->location}}</h5>
    @else
    <p>No activity to show.</p>
    @endif
</div>

@endsection