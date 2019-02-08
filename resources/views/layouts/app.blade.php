<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
<style>
    *{
        font-family: Trebuchet MS;
        font-size:16px;
    }
    th,td{
        text-align: center !important;
    }
    .btn-sm{
        font-size:14px;
    }
    .desc{
        color:#EB3B39;
        margin-bottom: 20px;
    }
    .navbar-default .navbar-nav > li > a:hover {
        color: #1CA1F2;
    }
</style>
</head>
<body>
@if (Auth::check())
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        {{--{{ setting('app.name', 'Laravel') }} {{setting('app.version')}}--}}
                        <div style="margin-top: -15px;">
                            <img src="{{url('storage/logo.png')}}" style="width:50px;">
                        </div>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                        @else
                            <li><a href="{{ url('/home') }}">Home</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Chat <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('chat_tweets') }}">Tweets</a></li>
                                    <li><a href="{{ url('chat') }}">Settings</a></li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Archive <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('tweets') }}">Tweets</a></li>
                                    <li><a href="{{ url('archive') }}">Settings</a></li>
                                </ul>
                            </li>

                            <li><a href="{{ url('schedule') }}">Schedule</a></li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">DM On Follow <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('dm') }}">DM Log</a></li>
                                    <li><a href="{{ url('dm_config') }}">Settings</a></li>
                                </ul>
                            </li>

                            <li><a href="{{ url('analytics') }}">Analytics</a></li>
                            <li><a href="{{ url('setting') }}">Settings</a></li>
                            <li><a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        @endif
        @yield('content')
    </div>
    <div class="container-fluid">
        <footer class="row">
            <div class="footer" style="text-align: center !important; font-size:14px !important; ">
                <p>Made With <span style="font-size:14px !important; color:#BD1831;" class="fa fa-heart"></span> By <a href="https://twitter.com/naifalshaye" target="_blank">Naif Alshaye</a> <span style="font-size: 12px;">version 1.0 [demo]</span></p>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $(':checkbox').checkboxpicker();
        });
    </script>
</body>
</html>
