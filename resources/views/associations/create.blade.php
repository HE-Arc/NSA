@extends('layouts.app')

@section('content')

@include('includes.validation')

@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
@endif

<div class="container">
    <form action="{{route('associations.store')}}" method="POST">
        @csrf
        <input type="text" name="name" required placeholder="Nom de l'association" value = "{{old('name')}}"><br />
        <input type="email" name="email" required placeholder="email" value = "{{old('email')}}"><br />
        <textarea name="description" id="" cols="30" rows="10" placeholder="Description" value ="{{old('description')}}"></textarea><br />

        <button type="submit">Créer</button><br />
    
    </form>
</div>

@endsection