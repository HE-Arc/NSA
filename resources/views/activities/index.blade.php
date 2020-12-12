@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/activities.css') }}" rel="stylesheet">
@endsection

@section('content')
@include('includes.validation')

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

<main class="main columns">


  <div class="column main-column">
    <a class="article first-article" href="#">
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
         <span>{{$firstActivity->date}}</span>
         <span>{{$firstActivity->location}}</span>
       </footer>
     </div>
    </a>
    
    <div class="columns">
    @foreach($bigActivities as $activity)
      <div class="column nested-column">
        <a class="article" href="#">
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
                <span>{{$activity->date}}</span>
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
    <a class="article" href="">
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
        <span>{{$activity->date}}</span>
                <span>{{$activity->location}}</span>
        </footer>
      </div>
    </a>
    @endforeach
  </div>
</main>


<!--
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
-->

@endsection