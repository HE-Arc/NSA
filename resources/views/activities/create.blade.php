@extends('layouts.app')

@section('content')

@include('includes.validation')

<div class="card-container">

    <div class="w-75 mx-auto card card-style font-weight-bold">

        <div class="h1 card-header font-weight-bold">Create an Activity</div>

        <div class="card card-body h-100 justify-content-center pl-5 pr-5">

            <form method="POST" action="{{ route('activities.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="w-50 form-group mb-3">
                    <label for="association_id">Association</label>
                    <select class="form-control" id="association_id" name="association_id" required>
                        <option value="" selected disabled hidden>Choose from the list ...</option>
                        @foreach($userAssociations as $association)
                        <option value="{{ $association->id }}">{{ $association->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-50 form-group mb-4">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                </div>
                <div class="form-group mb-4">
                    <label for="description">Description</label>
                    <textarea rows="6" class="form-control" id="description" name="description" required>{{ old('description') }}</textarea>
                </div>
                <div class="form-row mb-4">
                    <div class="form-group col-sm">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}" required>
                    </div>
                    <div class="form-group col-sm">
                        <label for="location">Location</label>
                        <input type="text" class="form-control" id="location" name="location" placeholder="Brasserie de La Fontaine, La Chaux-de-Fonds" value="{{ old('location')}}" required>
                    </div>
                    <div class="form-group col-sm">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/png, image/jpg, image/jpeg, image/gif">
                    </div>
                </div>
                <button type="submit" class="mt-2 btn btn-own-green">Creation</button>

            </form>

        </div>

    </div>

</div>

@endsection