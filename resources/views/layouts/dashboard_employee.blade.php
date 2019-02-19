<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
        <script defer src="https://use.fontawesome.com/releases/v5.7.1/js/all.js" integrity="sha384-eVEQC9zshBn0rFj4+TU78eNA19HMNigMviK/PU/FFjLXqa/GKPgX58rvt5Z8PLs7" crossorigin="anonymous"></script>
        
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        {{-- jQuery --}}
        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <link type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"></link>
        {{-- Moment js --}}
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        {{-- Datepicker --}}
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

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
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('instructions') }}">{{ __('Instructions') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('clocking') }}">{{ __('Clock-In') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('panel_index') }}">{{ __('Panel') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('settings') }}">{{ __('Settings') }}</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
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

            <div class="container">
                <div class="row py-4" id="body-row">
                    <!-- Sidebar -->
                    <div id="sidebar-container" class="d-none d-md-block col-md-3 col-lg-2">
                        <!-- Bootstrap List Group -->
                        <ul class="list-group sticky-top sticky-offset">
                            <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center">
                                <small>MAIN MENU</small>
                            </li>
                            <a href="{{ route('panel_index') }}" class="list-group-item">{{ __('Overview') }}</a>
                            <a href="{{ route('panel_users') }}" class="list-group-item">{{ __('Employees') }}</a>
                            <a href="{{ route('panel_users_create') }}" class="list-group-item">{{ __('Add employee') }}</a>
                            <li class="list-group-item sidebar-separator"></li>
                            <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center">
                                <small>ACTIONS</small>
                            </li>
                            <a href="#" class="list-group-item list-group-item-action p-2 d-flex justify-content-center">
                                <button class="btn btn-primary">Download Excel</button>
                            </a>
                            <li class="list-group-item sidebar-separator"></li>
                        </ul>
                        <!-- List Group END-->
                    </div>
                    <!-- sidebar-container END -->
                
                    <div class="col">
                        <main>
                            <div class="row">
                                <div class="col-lg-10">
                                    <div class="card">
                                        
                                        <div class="card-header">
                                            {{-- Actions --}}
                                            <ul class="nav nav-tabs card-header-tabs justify-content-center">
                                                <li class="nav-item">
                                                    <a href="{{ route('panel_users_show', $user->user_id) }}" class="nav-link">
                                                        <i class="fas fa-user mr-1"></i>
                                                        View
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{ route('panel_users_clockings', $user->user_id) }}" class="nav-link">
                                                        <i class="fas fa-calendar-check mr-1"></i>
                                                        Clock-In
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{ route('panel_users_edit', $user->user_id) }}" class="nav-link">
                                                        <i class="fas fa-user-edit mr-1"></i>
                                                        Edit
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    {{ Form::open(['method' => 'delete', 'route' => ['panel_users_delete', $user->user_id], 'class' => 'pull-right']) }}
                                                        {{ Form::button('<i class="fas fa-trash mr-1"></i> Delete', ['type' => 'submit', 'class' => 'nav-link btn btn-link text-muted', 'style' => 'border-radius: 0;']) }}
                                                    {{ Form::close() }}
                                                </li>
                                            </ul>
                                        </div>

                                        {{-- Card body --}}
                                        <div class="card-body">
                                            @if (session('status'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ session('status') }}
                                                </div>
                                            @endif
                                            @if(Session::has('message'))
                                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                            @endif
                                            
                                            @yield('content')
                                        </div> {{-- ./card-body end --}}

                                        {{-- Card footer --}}
                                        <div class="card-footer text-muted text-center">
                                                Employee Card
                                            </div>
                                        </div>
                                        
                                    </div> {{-- card end --}}
                                </div> {{-- col end --}}
                            </div> {{-- row end--}}
                        </main>
                    </div>
                </div> <!-- body-row end -->
            </div>
        </div>
    </body>
</html>
