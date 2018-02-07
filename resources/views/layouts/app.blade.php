<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
</head>
<body>
    <div id="app" class="content-bottom">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }} - Petitions
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="">
                                <i class="fa fa-file-text-o"></i> Petitions
                            </a>

                            @if (auth()->check())
                                @if($user->hasRole('admin'))
                                    <a href="">
                                        <i class="fa fa-users"></i> Users
                                    </a>

                                    <a href="">
                                        <i class="fa fa-bug"></i> Helpdesk
                                    </a>
                                @endif
                            @endif
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}"><i class="fa fa-sign-in"></i> Login</a></li>
                            <li><a href="{{ route('register') }}"><i class="fa fa-user-plus"></i> Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    <i class="fa fa-plus"></i> <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a href=""><i class="fa fa-fw fa-plus"></i> New petition</a></li>
                                    <li><a href="{{ route('helpdesk.create') }}"><i class="fa fa-fw fa-plus"></i> New support ticket</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="">
                                    <i class="fa fa-bell-o"></i>
                                </a>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    <i class="fa fa-user"></i> {{ $user->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('account.settings') }}">
                                            <i class="fa fa-fw fa-cogs"></i> Account settings
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fa fa-fw fa-power-off"></i> Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <footer id="myFooter">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h5>Get started</h5>
                    <ul>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h5>Legal</h5>
                    <ul>
                        <li><a href="{{ route('policy.disclaimer') }}">Disclaimer</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h5>Connect with us</h5>
                    <ul>
                        <li><a href="https://www.facebook.com/ActivismeBE/"><i class="fa fa-fw fa-facebook"></i> Facebook</a></li>
                        <li><a href="https://twitter.com/Activisme_be"><i class="fa fa-fw fa-twitter"></i> Twitter</a></li>
                        <li><a href="https://github.com/Misfits-BE/petitie-systeem"><i class="fa fa-fw fa-github"></i> GitHub</a></li>
                    </ul>
                </div>
                <div class="col-sm-3 info">
                    <h5>Information</h5>
                    <p> 
                        A small open-source petition system. Build and maintained by Activisme_BE. Because we want change in our society. It deserves it.
                    </p>
                </div>
            </div>
        </div>
        <div class="second-bar">
           <div class="container">
                <span>&copy; {{ date('Y') }} {{ config('app.name') }}, All rights reserved </span>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
