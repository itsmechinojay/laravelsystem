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
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!--Data Table library -->
    <link rel="stylesheet" href="{{ asset('/css/dataTables.bootstrap4.min.css')}}" />
</head>

<body style="background-image: url('{{ asset('image/bg3.png') }}');background-repeat:no-repeat;
            background-attachment:fixed;background-position:center;background-size:cover;">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel faded fixed-top" style="background-color:Light">


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
                            <a class="nav-link" href="/home">Home</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/about">About</a>
                        </li>
                    </ul>
                    @else
                    <ul class="navbar-nav mr-auto">

                        @if (Auth::check() && Auth::user()->type == 'Admin')

                        <li class="nav-item active">
                            <a class="nav-link" href="/home">Home</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/admin/employee">Employee</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/admin/client">Client</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/admin/request">Request</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/admin/account">Account</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/evaluation">Evaluation</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/notify" id="count">Notification</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/about">About</a>
                        </li>

                        @elseif (Auth::check() && Auth::user()->type =='Client')

                        <li class="nav-item active">
                            <a class="nav-link" href="/home">Home</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/client_employee">Employee</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/client_request">Request</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/evaluation">Evaluation</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/notify" id="count2">Notification</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/about">About</a>
                        </li>

                        @elseif (Auth::check() && Auth::user()->type =='Dev')
                        <li class="nav-item active">
                            <a class="nav-link" href="/home">Home</span></a>
                        </li>
                        <!--Admin -->
                        <li class="nav-item active">
                            <a class="nav-link btn-hover" href="/admin/employee">Admin Employee</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/admin/client">Admin Client</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/admin/request">Admin Request</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/admin/account">Admin Account</a>
                        </li>
                        <!--Client -->
                        <li class="nav-item active">
                            <a class="nav-link" href="/client_employee">Client Employee </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/client_request">Client Request</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/about">About</a>
                        </li>
                        <!-- Employee-->

                        @elseif (Auth::check() && Auth::user()->type =='Employee')
                        <li class="nav-item active">
                            <a class="nav-link" href="/profile">Profile</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/deploymenthistory">Deployment History</a>
                        </li>

                        @endif

                    </ul>
                    @endguest

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register')) {{--
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li> --}} @endif @else
                        <li class="nav-item dropdown ">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                {{-- <a data-toggle="modal" data-target="#changepassModal" id="btn-changepass" class="dropdown-item">Change Password</a> --}}

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

        <main class="py-4" style="margin-top:5%">
            @yield('content')
        </main>
    </div>


    <!-- Modal -->
    <!-- Modal -->
    <div class="modal fade" id="changepassModal" tabindex="-1" role="dialog" aria-labelledby="passModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form id="form-add-employee" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="passModalLabel">Change Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button id="btn-change-pass" type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script>
        $(document).ready(function() {
        setInterval("getAdminNotyCount()",2000);
        setInterval("getClientNotyCount()",2000);
    });
    

    function getAdminNotyCount() { 
     $.ajax({
     type: "GET",
     url: "/count",
     success: function(response){
         json_object = JSON.parse(response)
         var count = json_object.count
         console.log(count);
         $('#count').text('Notification(' + count +')');
     }
     });
     }

     function getClientNotyCount() { 
     $.ajax({
     type: "GET",
     url: "/count/client",
     success: function(response){
         json_object = JSON.parse(response)
         var count = json_object.count
         console.log(count);
         $('#count2').text('Notification(' + count +')');
     }
     });
     }

    </script>

    <!--Bootstrap 4 DataTable jquery -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('script/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('script/dataTables.min.js')}}"></script>

</body>

</html>