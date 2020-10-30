@extends('layouts.app')

@section('content')

@include('includes.validation')

<h1>Create an Association</h1>

<form action="{{route('associations.store')}}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" required value = "{{old('name')}}">
    </div>
    <div class="form-group">
        <label for="description">Email</label>
        <input type="email" class="form-control" id="email" name="email" required value = "{{old('email')}}">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{old('description')}}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Create an association</button>
</form>

@endsection