@extends('layouts.app')

@section('content')

@include('includes.validation')

<div class="card-container">

    <div class="w-75 mx-auto card card-style font-weight-bold" style="min-height: 50em">

        <div class="h1 card-header font-weight-bold">Update an Activity</div>

        <div class="mt-2 ml-2">
            <a class="btn btn-own-red" href="{{ route('activities.index') }}" title="Go back"><i class="fas fa-backward ">&nbsp;&nbsp;</i>Go back</a>
        </div>

        <div class="card card-body h-100 justify-content-center pl-5 pr-5 border-top-0">

            <form method="POST" action="{{ route('activities.update', $activity) }}" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="w-50 form-group mb-3">
                    <label for="association_id">Association</label>
                    <select class="form-control" id="association_id" name="association_id" required>
                        @foreach($userAssociations as $association)
                        @if($association->id == $activity->association_id)
                        <option value="{{ $association->id }}" selected>{{ $association->name }}</option>
                        @else
                        <option value="{{ $association->id }}">{{ $association->name }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="w-50 form-group mb-4">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $activity->title }}">
                </div>
                <div class="form-group mb-4">
                    <label for="description">Description</label>
                    <textarea rows="6" class="form-control" id="description" name="description">{{ $activity->description }}</textarea>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{ $activity->date }}">
                    </div>
                    <div class="form-group col-sm">
                        <label for="location">Location</label>
                        <input type="text" class="form-control" id="location" name="location" placeholder="Brasserie de La Fontaine, La Chaux-de-Fonds" value="{{ $activity->location }}">
                    </div>
                    <div class="form-group col-sm">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image" files="asdasd" accept="image/png, image/jpg, image/jpeg, image/gif">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm align-self-center">
                        <button type="submit" class="btn btn-own-green text-white font-weight-bold">Update</button>
                    </div>
                    @if(!is_null($activity->image))
                    <div class="col-sm"></div>
                    <div class="text-center col-sm align-self-center">
                        @php
                        error_log($activity->image->src)
                        @endphp
                        <img width="100em" height="100em" src="{{ $activity->image->src }}" />
                    </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection