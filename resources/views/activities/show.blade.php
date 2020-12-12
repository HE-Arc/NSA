@extends('layouts.app')

@section('content')

@auth
@php
$activities = Auth::user()->activities();
$activitiesIds_Joined = $activities->pluck('id')->toArray();

$associations_owner = Auth::user()->associations()->pluck('id')->toArray();
@endphp
@endauth

@include('includes.validation')

<div class="card-container">

    <div class="text-center w-75 mx-auto card card-style card-style-show font-weight-bold pl-4 pb-4 pr-4 pt-4">

        <div class="form-row mb-3">
            <div class="form-group col-sm">
                <h5><strong>Date :</strong> {{date('d.m.Y', strtotime($activity->date))}}</h5>
            </div>
            <div class="form-group col-sm">
                @auth
                <span>
                    @if(in_array($activity->id, $activitiesIds_Joined))
                    <form method="POST" style="display:inline" action="{{route('unparticipate',['activity' => $activity, 'user' => Auth::user()])}}">
                        @csrf
                        <button type="submit" class="btn btn-outline-dark m-0 pt-0 pb-0"><span>Unjoin</span></button>
                    </form>
                    @else
                    <form method="POST" style="display:inline" action="{{route('participate',['activity' => $activity, 'user' => Auth::user()])}}">
                        @csrf
                        <button type="submit" class="btn btn-outline-success m-0 pt-0 pb-0"><span>Join</span></button>
                    </form>
                    @endif
                </span>
                @endauth
            </div>
            <div class="form-group col-sm">
                <h5><strong>Location :</strong> {{$activity->location}}</h5>
            </div>
        </div>

        <div class="form-row mb-3">
            <div class="text-center col-sm align-self-center">
                <h1>{{$activity->title}}</h1>
            </div>
        </div>

        @if(!is_null($activity->image))
        <div class="form-row mb-2">    
            <div class="text-center col-sm align-self-center">

                <img style="max-width:100%" src="{{ $activity->image->src }}" />
            </div>         
        </div>
        @endif

        <div class="card card-body h-100 col-sm justify-content-center pl-4 pr-4 border-0">
            <div class="text-center form-group mb-4">
                <h5>{{$activity->description}}</h5>
            </div>
        </div>
        @auth
        @if(in_array($activity->association_id,$associations_owner))
        <form action="{{ route('activities.destroy', $activity) }}" method="POST" style="display:inline">
            <a href="{{ route('activities.edit', $activity) }}" title="Edit" class="text-dark">
                <i class="btn btn-outline-success fa fa-edit fa-lg pt-2 pb-2 pl-3"></i>
            </a>      
            @csrf
            @method('DELETE')
            <button type="submit" title="Delete" class="btn btn-outline-danger fa fa-trash fa-lg pt-2 pb-2 pl-3 pr-3">
            </button>
        </form>
        @endif
        @endauth
    </div>
</div>

@endsection