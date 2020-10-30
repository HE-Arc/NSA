
@extends('layouts.app')

@section('content')
@include('includes.validation')

<div class="container">
    @if(isset($association))
    <h1>{{$association->name}}</h1>
    <h5>Contact (email) : {{$association->email}}</h5>
    <p>{{$association->description}}</p>
    <a href="test" class="text-dark btn btn-primary btn-lg">Subscribe <i class="fa fa-plus-circle fa-lg"></i></a>
    @else
    <p>No association to show.</p>
    @endif
</div>

@endsection