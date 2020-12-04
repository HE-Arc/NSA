<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'NSA') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">   

     <!-- Custom styles for this template -->
    <link href="{{asset('css/sidebar.css')}}" rel="stylesheet">
    @yield('styles')

</head>

<body>
    <div id="app">
        <div class="d-flex toggled" id="wrapper">
        <!-- Sidebar -->
        @auth
        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading">Welcome <b>{{ Auth::user()->name }}!</b></div>
            <div class="sidebar-heading2">Subscriptions</div>
            <div class="list-group list-group-flush">
                @foreach(Auth::user()->subscriptions()->get() as $associationSubscribed)
                    <a href="{{route('associations.show', $associationSubscribed)}}" class="list-group-item list-group-item-action bg-light">{{$associationSubscribed->name}}</a>
                @endforeach
            </div>
            <div class="list-group list-group-bottom">
                <a class="list-group-item list-group-item-action bg-light" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                </a>
            </div>
        </div>
        @endauth
        <!-- /#sidebar-wrapper -->


        <div id="page-content-wrapper">

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
            <button class="fa fa-bars btn btn-light mr-3" id="menu-toggle"></button>
                <a class="navbar-brand" href="{{ route('activities.index') }}">
                    {{ config('app.name', 'NSA') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('activities.index') }}">{{ __('Activities') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('associations.index') }}">{{ __('Associations') }}</a>
                        </li>
                        @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('activities.create') }}">{{ __('Create Activity') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('associations.create') }}">{{ __('Create Association') }}</a>
                        </li>
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        
                        @else
                        <!--
                        
                        <li class="nav-item dropdown">
                            
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>-->
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


        <div class="container-fluid">

        <main class="py-4">
            @yield('content')
        </main>

        </div>
</div>
    </div>
</div>
    @yield('scripts')
    <!-- Menu Toggle Script -->
    <script>
        $(document).ready(function(){

        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    });
    </script>

    
</body>

</html>