<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>WSI</title>
    <script src="//code.jquery.com/jquery-1.11.3.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!--Data Table library -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap2.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/dataTables.bootstrap4.min.css')}}" />
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel faded">


            <div class="container">

                <img src="{{ asset('image/logo1.png')}}" class="img-fluid" style="width:20%">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <!-- Authentication Links -->
                    @guest
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="/">Home</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/about">About</a>
                        </li>
                    </ul>
                    @else
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="/">Home</span></a>
                        </li>

                        @if (Auth::check() && Auth::user()->type == 'Admin')
                        <li class="nav-item active">
                            <a class="nav-link" href="/admin/employee">Employee</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/admin/client">Client</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/admin/request">Request</a>
                        </li>

                        @elseif (Auth::check() && Auth::user()->type =='Client')
                        <li class="nav-item active">
                            <a class="nav-link" href="client_employee">Employee</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/client_request">Request</a>
                        </li>

                        @endif

                        <li class="nav-item active">
                            <a class="nav-link" href="/about">About</a>
                        </li>
                    </ul>
                    @endguest

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li> --}}
                        @endif @else
                        <li class="nav-item dropdown ">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!--Bootstrap 4 DataTable jquery -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('script/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('script/dataTables.min.js')}}"></script>
</body>

</html>