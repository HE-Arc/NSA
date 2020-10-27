@extends('layouts.app')

@section('content')

@include('includes.validation')

<h1>Update an Activity</h1>

<form method="POST" action="{{ route('activities.update', $activity) }}" enctype="multipart/form-data">
    @csrf
    @method('put')
    
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ $activity->title }}">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description">{{ $activity->description }}</textarea>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ $activity->date }}">
        </div>
        <div class="form-group col-md-6">
            <label for="location">Location</label>
            <input type="text" class="form-control" id="location" name="location" value="{{ $activity->location }}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="image">Image</label>
            <input type="file" class="form-control" id="image" name="image" files="asdasd" accept="image/png, image/jpg, image/jpeg, image/gif">
        </div>
    </div>
    <div>
        <img width="100em" height="100em" src="{{ $activity->image->src }}" /> <!-- @TODO -->
    </div>
    <button type="submit" class="btn btn-primary">Update an activity</button>
</form>

@endsection