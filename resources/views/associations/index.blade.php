@extends('layouts.app')

@section('content')
@include('includes.validation')

<div class="container">
    <h1>Associations list</h1>
    <div class="row justify-content-center">
    <table class="table table-striped bg-white">
    <thead class="thead-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col" class="text-center">Actions</th>
        </tr>
        </thead>
        @foreach($associations as $association)
            <tr style="cursor:pointer;z-index=99" onclick="window.location.href = '{{route('associations.show', $association)}}';">
                <th scope="row">{{$association->id}}</td>
                <td>{{$association->name}}</td>
                <td>{{$association->email}}</td>
                <td class="text-center">
                @if(Auth::check()&&$association->user_id === Auth::user()->id)
                <form action="{{ route('associations.destroy', $association) }}" method="POST">

                    <a href="{{ route('associations.edit', $association) }}" title="Edit" class="text-dark">
                        <i class="fa fa-edit fa-lg"></i>
                    </a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" title="Delete" style="padding:0;border: none; background-color:transparent;">
                        <i class="fa fa-trash fa-lg"></i>
                    </button>
                    </form>
                @else
                    @if(Auth::check())
                        <a href="{{route('subscribe', ['association' => $association, 'user' => Auth::user()])}}" class="fa fa-plus-circle fa-lg text-dark"></a>
                    @else
                        <a href="" class="fa fa-plus-circle fa-lg text-dark"></a><!-- TODO: change here for proposing the user to log -->
                    @endif
                @endif
                </td>              
            </tr>

        @endforeach
        </table>
        
    </div>
    <a href="{{ route('associations.create') }}" class="btn btn-primary btn-lg">Create Association</a>
</div>
@endsection