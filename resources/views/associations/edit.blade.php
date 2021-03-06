@extends('layouts.app')

@section('content')

@include('includes.validation')

<div class="card-container">

    <div class="w-75 mx-auto card card-style font-weight-bold">

        <div class="h1 card-header font-weight-bold">Update an Association</div>

        <div class="card card-body h-100 justify-content-center pl-5 pr-5 border-top-0">

            <form action="{{ route('associations.update', $association) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="w-50 form-group mb-4">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $association->name }}" placeholder="Name">
                </div>
                <div class="w-50 form-group mb-4">
                    <label for="description">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="exemple@ne.ch" value="{{ $association->email }}">
                </div>
                <div class="form-group mb-4">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{ $association->description }}</textarea>
                </div>
                <button type="submit" class="mt-2 btn btn-own-green">Update</button>

            </form>

        </div>
    </div>
</div>

@endsection