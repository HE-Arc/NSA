@extends('layouts.app')

@section('content')

@include('includes.validation')

<div class="w-75 mx-auto card card-shadow border border-success font-weight-bold" style="min-height: 50em">

    <div class="h1 card-header bg-gradient-success text-white font-weight-bold">Create an Association</div>

    <div class="card card-body h-100 justify-content-center pl-5 pr-5">

        <form action="{{route('associations.store')}}" method="POST">
            @csrf

            <div class="w-50 form-group mb-4">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required value="{{old('name')}}">
            </div>
            <div class="w-50 form-group mb-4">
                <label for="description">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="exemple@ne.ch" required value="{{old('email')}}">
            </div>
            <div class="form-group mb-4">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{old('description')}}</textarea>
            </div>
            <button type="submit" class="mt-2 btn text-white font-weight-bold" style="background-color:#007E33">Creation</button>

        </form>

    </div>

</div>

@endsection