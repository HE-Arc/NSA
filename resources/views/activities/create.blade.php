@extends('layouts.app')

@section('content')

@include('includes.validation')

<h1>Create an Activity</h1>

<form method="POST" action="{{ route('activities.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" value = "{{ old('title') }}">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date" name="date" value = "{{ old('date') }}">
        </div>
        <div class="form-group col-md-6">
            <label for="location">Location</label>
            <input type="text" class="form-control" id="location" name="location" value = "{{ old('location') }}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="image">Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/png, image/jpg, image/jpeg, image/gif">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Create an activity</button>
</form>

@endsection