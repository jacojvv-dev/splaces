<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Splaces') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/site.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">

    <nav class="navbar is-dark">
        <div class="navbar-brand">
            <div class="navbar-burger burger" data-target="navMenu">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <div class="navbar-menu" id="navMenu">
            {{--home button--}}
            <div class="navbar-start">
                @if(last(request()->segments()) === false)
                    <router-link to="/" class="navbar-item" exact>
                        {{ config('app.name', 'Splaces') }}
                    </router-link>
                @else
                    <a class="navbar-item" href="{{url('/')}}">Splaces</a>
                @endif
            </div>

            {{--login and profile section--}}
            <div class="navbar-end">
                @if (Route::has('login'))
                    @auth
                        <div class="navbar-item  has-dropdown is-hoverable">
                            <a class="navbar-link ">
                                Welcome back, {{ Auth::user()->name  }}
                            </a>
                            <div class="navbar-dropdown">
                                {{--<a class="navbar-item" href="{{ url('/dashboard') }}">--}}
                                {{--Dashboard--}}
                                {{--</a>--}}

                                <template v-if="user && user.venues.length > 0">
                                    <router-link :to="'/venue/' + userVenue.venue_id"
                                                 v-for="userVenue in user.venues"
                                                 class="dropdown-item"
                                                 :key="userVenue.venue_id">
                                        @{{ userVenue.venue_name }}
                                    </router-link>
                                    {{--<a href="#" class="dropdown-item">--}}
                                    {{--Other dropdown item--}}
                                    {{--</a>--}}
                                    <hr class="dropdown-divider">
                                </template>

                                <a class="navbar-item"
                                   href="{{ route('logout') }}"
                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </div>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    @else
                        <div class="navbar-item">
                            <div class="top-right links">
                                <div class="field is-grouped">
                                    <p class="control">
                                        <a class="button is-default" href="{{url('/login')}}">
                                            <span><i class="fas fa-sign-in-alt"></i> Login</span>
                                        </a>
                                    </p>
                                    <p class="control">
                                        <a class="button is-primary" href="{{url('/register')}}">
                                            <span><i class="fas fa-user-plus"></i> Register</span>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endauth
                @endif
            </div>
        </div>
    </nav>


    <main>
        @yield('content')
    </main>
</div>

<script src="{{ asset('js/vendor.js') }}"></script>
@yield('scripts')
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

</body>
</html>
