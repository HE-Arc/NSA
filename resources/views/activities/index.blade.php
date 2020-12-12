@extends('layouts.app')

@section('content')

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>
<script type="text/javascript" src="{{ asset('js/elementmove.js') }}"></script>
<script>
var activities = [
    @foreach($activities as $activity)
        [$activity],
    @endforeach
    ];
    
    function filterSelection(c){
        if(c=="today"){
            let today = new Date().toISOString().slice(0, 10)
            filterActivities = activities.filter(activity => activity.date == today)

        }
        if(c=="date"){
            //change button to selection type
        }
        for (let index = 0; index < activities.length; index++) {
            const element = activities[index];
            
        }
    }
</script>
@endsection

@include('includes.validation')
<nav class="navbar navbar-light bg-light" style="background-color: #16a74e;">
    <a class="nav-link" href="?filter=all">All activities</a>
    <a class="nav-link" href="?filter=today">Today</a>
    <form action="" method="get" class="form-inline">
    <input type="hidden" name="filter" value="date">
    <input type="date" class="form-control mr-sm-2" name="date" require>
    <input class="btn btn-outline-primary" type="submit" value="Search">
    </form>
</nav>
<ul class="flex-container pl-5 pr-5">
    <li class="row justify-content-center">
    @foreach($activities ?? '' as $activity)
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