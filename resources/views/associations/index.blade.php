@extends('layouts.app')

@section('scripts')
<script type="text/javascript" src="{{ asset('js/subscribeButton.js') }}"></script>
@endsection

@section('styles')
<link href="{{ asset('css/subscribeButton.css') }}" rel="stylesheet">
@endsection

@section('content')
@include('includes.validation')

<div class="card-container">

    <div class="container card-item">
        <h1 class="mt-3 mb-5" style="font-weight: bold;">Associations list</h1>
        <div class="mb-5 row justify-content-center">
            <table class="table table-striped bg-white">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>

                @auth
                @php
                $subscriptions = Auth::user()->subscriptions();
                $associationIds_subscribed = $subscriptions->pluck('id')->toArray();
            @endphp
        @endauth
        
        @foreach($associations as $association)
            <tr style="cursor:pointer;z-index=99" onclick="window.location.href = '{{route('associations.show', $association)}}';">
                <td>{{$association->name}}</td>
                <td>{{$association->email}}</td>
                <td class="text-center">
                    @auth
                    @if(in_array($association->id,$associationIds_subscribed))
                    
                        <form method="POST" style="display:inline" action="{{route('unsubscribe',['association' => $association, 'user' => Auth::user()])}}">
                            @csrf
                            <button type="submit" class="btn m-0 p-0"><span class="fa fa-check-circle fa-lg text-success subscribeButton"></span></button>
                        </form>
                        <!--<a href="{{route('unsubscribe',['association' => $association, 'user' => Auth::user()])}}" class="fa fa-check-circle fa-lg text-success subscribeButton" ></a>-->
                    @else
                        <form method="POST" style="display:inline" action="{{route('subscribe',['association' => $association, 'user' => Auth::user()])}}">
                            @csrf
                            <button type="submit" class="btn m-0 p-0"><span class="fa fa-plus-circle fa-lg text-dark"></span></button>
                        </form>
                        <!--<a href="{{route('subscribe', ['association' => $association, 'user' => Auth::user()])}}" class="fa fa-plus-circle fa-lg text-dark"></a>-->                        
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
                    <i>You are disconnected</i>      
                @endauth
                </td>
                </tr>
                @endforeach
            </table>

        </div>
        <a href="{{ route('associations.create') }}" class="btn btn-own-green btn-lg mb-3">Create Association</a>
    </div>

</div>
@endsection