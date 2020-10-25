@extends('layouts.app')

@section('content')

    @include('includes.validation')

<div class="container">
    <form action="{{route('associations.store')}}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Nom de l'association"><br />
        <input type="text" name="email" placeholder="email"><br />
        <textarea name="description" id="" cols="30" rows="10" placeholder="Description"></textarea><br />

        <button type="submit">Créer</button><br />
    
    </form>
</div>

@endsection