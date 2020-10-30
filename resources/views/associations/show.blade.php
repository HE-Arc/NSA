
@extends('layouts.app')

@section('content')
@include('includes.validation')

<div class="container">
    @if(isset($association))
        <h1>{{$association->name}}</h1>
        <h5>Contact (email) : {{$association->email}}</h5>
        <p>{{$association->description}}</p>
        @if(Auth::check())
            <a href="{{route('subscribe', ['association' => $association, 'user' => Auth::user()])}}" class="text-dark btn btn-primary btn-lg">Subscribe <i class="fa fa-plus-circle fa-lg"></i></a>
        @else
            <a href="" class="text-dark btn btn-primary btn-lg">Subscribe <i class="fa fa-plus-circle fa-lg"></i></a><!-- TODO: CHANGE TO PROPOSE USER TO CONNECT -->
        @endif
    @else
    <p>No association to show.</p>
    @endif
</div>

@endsection