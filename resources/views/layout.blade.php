<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title') - Wonderful Journey</title>
        <script src="{{ asset('assets/scripts/jquery-3.5.1.min.js') }}"></script>
        <script src="{{ asset('assets/bootstrap/4.0.0/js/bootstrap.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('assets/bootstrap/4.0.0/css/bootstrap.min.css') }}">
    </head>
    <body>
        <header class="mb-3 bg-gray">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="/">
                        <strong style="font-size: 20px;"><span class="text-secondary">Wonderful</span> Journey</strong>
                    </a>
                    {{-- menu icon --}}
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    {{-- menu item --}}
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{route('home')}}">Home</a>
                            </li>
                            <li class="nav-item active dropdown">
                                <a id="categoryDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Category
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="categoryDropdown">
                                    @foreach (App\Category::all() as $category)
                                    <a class="dropdown-item" href="{{route('home.category',$category->id)}}">
                                        {{$category->name}}
                                    </a>
                                    @endforeach
                                </div>
                            </li>
                            @guest
                            @else
                                @if (Auth::user()->role == 'admin')
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{route('user')}}">Users</a>
                                </li>
                                @else
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{route('blog')}}">My Blog</a>
                                </li>
                                @endif
                            @endguest
                        </ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('login')}}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('register')}}">Register</a>
                            </li>
                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('profile')}}">
                                        Profile
                                    </a>
                                    <a class="dropdown-item" href="#" 
                                        onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                    >
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{route('logout')}}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <div class="container">
                @yield('content')
            </div>
        </main>
    </body>
</html>
