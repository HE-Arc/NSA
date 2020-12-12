@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/activities.css') }}" rel="stylesheet">
@endsection

@section('content')

@php
$willBeBig = function($index){return $index%2==0;};
$i = 0;
$bigActivities = [];
$tinyActivities = [];
$firstActivity = NULL;
foreach($activities as $activity)
{
    if($i == 0)
    {
        $firstActivity = $activity;
    }
    elseif($willBeBig($i))
    {
        array_push($bigActivities,$activity);
    }
    else
    {
        array_push($tinyActivities,$activity);
    }
    $i++;
}
@endphp

@auth
@php
  $activities = Auth::user()->activities();
  $activitiesIds_Joined = $activities->pluck('id')->toArray();
@endphp
@endauth

@include('includes.validation')

<nav class="navbar navbar-light bg-light" style="background-color: #16a74e;">
    <a class="nav-link" href="?filter=all">All activities</a>
    <a class="nav-link" href="?filter=today">Today</a>
    @auth
    <a class="nav-link" href="?filter=joined">Joined activity</a>
    @endauth
    <form action="" method="get" class="form-inline">
    <input type="hidden" name="filter" value="date">
    <input type="date" class="form-control mr-sm-2" name="date" require>
    <input class="btn btn-outline-primary" type="submit" value="Search">
    </form>
</nav>

<div class="card-container">

<main class="main columns">


  <div class="column main-column">
  @if(!is_null($firstActivity))
    <a class="article first-article" href="{{route('activities.show', $firstActivity)}}">
    @if(!is_null($firstActivity->image))
      <figure class="article-image is-4by3">
        <img src="{{$firstActivity->image->src}}" alt="image article">
      </figure>
      @endif
     <div class="article-body">
       <h2 class="article-title">
         {{$firstActivity->title}}
       </h2>
       <p class="article-content">
         {{$firstActivity->getWrappedTinyDesc()}}
       </p>
       <footer class="article-info">
          <span>{{date('d.m.Y', strtotime($activity->date))}}</span>
          @auth
          <span>
            @if(in_array($firstActivity->id,$activitiesIds_Joined))
              <form method="POST" style="display:inline" action="{{route('unparticipate',['activity' => $firstActivity, 'user' => Auth::user()])}}">
                @csrf
                <button type="submit" class="btn btn-outline-dark m-0 pt-0 pb-0"><span>Unjoin</span></button>
              </form>
            @else
              <form method="POST" style="display:inline" action="{{route('participate',['activity' => $firstActivity, 'user' => Auth::user()])}}">
                  @csrf
                  <button type="submit" class="btn btn-outline-success m-0 pt-0 pb-0"><span>Join</span></button>
              </form>                    
            @endif
          </span>
          @endauth
          <span>{{$firstActivity->location}}</span>
       </footer>
     </div>
    </a>
    @endif
    <div class="columns">
    @foreach($bigActivities as $activity)
      <div class="column nested-column">
        <a class="article" href="{{route('activities.show', $activity)}}">
        @if(!is_null($activity->image))
          <figure class="article-image is-16by9">
            <img src="{{$activity->image->src}}" alt="">
          </figure>
        @endif
          <div class="article-body">
            <h2 class="article-title">
                {{$activity->title}}
            </h2>
            <p class="article-content">
              {{$activity->getWrappedBigDesc()}}
            </p>
            <footer class="article-info">
                <span>{{date('d.m.Y', strtotime($activity->date))}}</span>
                @auth
                <span>
                  @if(in_array($activity->id,$activitiesIds_Joined))
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
                <span>{{$activity->location}}</span>
            </footer>
          </div>
        </a>
      </div>
    @endforeach
      
    </div>
  </div>
  <div class="column">
    @foreach($tinyActivities as $activity)
    <a class="article" href="{{route('activities.show', $activity)}}">
    @if(!is_null($activity->image))
      <figure class="article-image is-3by2">
      <img src="{{$activity->image->src}}" alt="">
      </figure>
      @endif
      <div class="article-body">
        <h2 class="article-title">
        {{$activity->title}}
        </h2>
        <p class="article-content">
        {{$activity->getWrappedTinyDesc()}}
        </p>
        <footer class="article-info">
        <span>{{date('d.m.Y', strtotime($activity->date))}}</span>
        @auth
        <span>
          @if(in_array($activity->id,$activitiesIds_Joined))
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
        <span>{{$activity->location}}</span>
        </footer>
      </div>
    </a>
    @endforeach
  </div>
</main>

</div>

@endsection