@extends('layouts.app')

@section('content')
@include('includes.validation')

<div class="card-container">

    <div class="w-50 mx-auto card card-style card-style-show font-weight-bold pl-4 pb-4 pr-4 pt-4">

        <div class="w-50 form-group mb-4">
            <h1>{{$association->name}}</h1>
        </div>
        <div class="w-50 form-group mb-4">
            <h5><strong>Contact (email) :</strong> {{$association->email}}</h5>
        </div>
        <div class="form-group mb-4">
            <h5>{{$association->description}}</h5>
        </div>

        @if(Auth::check())
        @php
        $subscriptionsIds = Auth::user()->subscriptions()->pluck('id')->toArray();
        @endphp
        @if(in_array($association->id,$subscriptionsIds))
        <a href="{{route('unsubscribe', ['association' => $association, 'user' => Auth::user()])}}" class="btn btn-danger btn-lg">Unsubscribe <i class="fa fa-plus-circle fa-lg"></i></a>
        @else
        <a href="{{route('subscribe', ['association' => $association, 'user' => Auth::user()])}}" class="btn btn-success btn-lg">Subscribe <i class="fa fa-plus-circle fa-lg"></i></a>
        @endif
        @else
        <i>You can't subscribe if you are not connected.</i>
        @endif
    </div>
</div>
</div>

@endsection

<!-- Save au cas ou ! -->

<!-- <div class="container">
        @if(isset($association))
        <h1>{{$association->name}}</h1>
        <h5>Contact (email) : {{$association->email}}</h5>
        <p>{{$association->description}}</p>
        @if(Auth::check())
        @php
        $subscriptionsIds = Auth::user()->subscriptions()->pluck('id')->toArray();
        @endphp
        @if(in_array($association->id,$subscriptionsIds))
        <a href="{{route('unsubscribe', ['association' => $association, 'user' => Auth::user()])}}" class="btn btn-danger btn-lg">Unsubscribe <i class="fa fa-plus-circle fa-lg"></i></a>
        @else
        <a href="{{route('subscribe', ['association' => $association, 'user' => Auth::user()])}}" class="btn btn-success btn-lg">Subscribe <i class="fa fa-plus-circle fa-lg"></i></a>
        @endif
        @else
        <i>You can't subscribe if you are not connected.</i>
        @endif
        @else
        <p>No association to show.</p>
        @endif
    </div> -->