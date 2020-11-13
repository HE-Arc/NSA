@extends('layouts.app')

@section('scripts')
<script type="text/javascript" src="{{ asset('js/subscribeButton.js') }}"></script>
@endsection

@section('content')
@include('includes.validation')


<link href="{{ asset('css/subscribeButton.css') }}" rel="stylesheet">

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
        @php
            $associationIds_subscribed = Auth::user()->subscriptions->pluck('id')->toArray();
        @endphp
        @foreach($associations as $association)
            <tr style="cursor:pointer;z-index=99" onclick="window.location.href = '{{route('associations.show', $association)}}';">
                <th scope="row">{{$association->id}}</td>
                <td>{{$association->name}}</td>
                <td>{{$association->email}}</td>
                <td class="text-center">
                @auth
                    @if(in_array($association->id,$associationIds_subscribed))
                        <a href="{{route('unsubscribe',['subscription' => $association])}}" class="fa fa-check-circle fa-lg text-success" id="subscribeButton"></a>
                    @else
                        <a href="{{route('subscribe', ['association' => $association, 'user' => Auth::user()])}}" class="fa fa-plus-circle fa-lg text-dark"></a>                        
                    @endif
                    @if($association->user_id === Auth::user()->id)
                    <form action="{{ route('associations.destroy', $association) }}" method="POST" style="display:inline">
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
                            
                    @endif
                @else
                    <a href="" class="fa fa-plus-circle fa-lg text-dark">you are disconnected</a>       
                @endauth
                </td>              
            </tr>

        @endforeach
        </table>
        
    </div>
    <a href="{{ route('associations.create') }}" class="btn btn-primary btn-lg">Create Association</a>
</div>
@endsection


