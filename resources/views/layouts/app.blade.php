<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre href="{{ url('/user/profile') }}" >
                                    {{ Auth::user()->name }}
                                </a>
                            </li>

                                @if(Auth::user()->role == 2 || Auth::user()->role == 3)
                                <li><b>Museum Management</b>
                                <ul>
                                    <li>
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre href="{{ url('/addArtwork') }}" > Add new Artwork</a>
                                    </li>
                                    <li>
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre href="{{ url('/chooseMuseumForRemoveArtwork') }}" > Remove Artwork</a>
                                    </li>
                                    <li>
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre href="{{ url('/chooseMuseumForTracking') }}" > Visitor Tracker</a>
                                    </li>
                                </ul>
                                </li>
                                @endif

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                    </li>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                                @if(Auth::user()->role == 1)
                                    <li>
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ url('bookingTicket') }}" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            Booking tickets
                                        </a>
                                    </li>
                                    <li>
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ url('tickets') }}" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            Tickets
                                        </a>
                                    </li>
                                    @isset($ticket_used)
                                        @if($ticket_used == True)
                                            <li>
                                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ url('feedbackMuseumsAndArtworks') }}" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                    Give a feedback to museums and artworks!
                                                </a>
                                            </li>
                                        @endif
                                    @endisset
                                    <li>
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ url('socialArea') }}" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            Go to social area
                                        </a>
                                    </li>
                                @endif
                                @if(Auth::user()->role == 2)
                                    <li>
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ url('ticketValidator/chooseMuseum') }}" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            Tickets validation
                                        </a>
                                    </li>
                                    <li>
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ url('tagDecoupling') }}" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            Tag Decoupling
                                        </a>
                                    </li>
                                    <li>
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ url('/timeslot/chooseMuseum') }}" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            Add Time Slot 
                                        </a>
                                    </li>
                                    <li>
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ url('/timeslot/chooseMuseumToShow') }}" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            Remove Time Slot
                                        </a>
                                    </li>
                                @endif
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
