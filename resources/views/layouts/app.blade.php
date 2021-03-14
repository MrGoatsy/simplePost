<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Simple Post</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/autosize@4.0.2/dist/autosize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
    <script src="{{asset('js/ajax.js')}}"></script>
    <style>
        a{
            text-decoration: none !important;
        }
        h1{
            color: white;
        }
        body{
            color: white;
        }
    </style>
</head>
<body class="site d-flex flex-column min-vh-100">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid text-end">
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a href="{{route('home')}}" class="nav-link">Home</a></li>
                        <li class="nav-item"><a href="{{route('posts')}}" class="nav-link">Posts</a></li>
                        @moderator
                            <li class="nav-item"><a href="{{route('dashboard')}}" class="nav-link">Dashboard</a></li>
                        @endmoderator
                    </ul>
                    <ul class="navbar-nav mx-auto mb-2 mt-2 mb-lg-0">
                        <form action="{{route('search.posts')}}" method="get">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="search" value="{{isset($_GET['search'])? $_GET['search'] : ''}}" />
                                <button class="btn btn-success bi bi-search" type="submit" id="search"> Search</button>
                            </div>
                        </form>
                    </ul>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        @auth
                            <li class="nav-item"><a href="{{route('users.posts', Auth::user()->username)}}" class="nav-link">{{Auth::user()->username}}</a></li>
                            <li class="nav-item">
                                <form action="{{route('logout')}}" method="post" class="nav-link">
                                    @csrf
                                    <button type="submit" class="bg-transparent border-0 shadow-none" style="color: rgb(167, 167, 167);">Logout</button>
                                </form>
                            </li>
                        @endauth
                        @guest
                            <li class="nav-item"><a href="{{route('register')}}" class="nav-link">Register</a></li>
                            <li class="nav-item"><a href="{{route('login')}}" class="nav-link">Login</a></li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="site-content flex-fill" style="background-color: black; opacity: 90%">
        <div class="container-fluid">
            <div class="row mt-2">
                @yield('content')
            </div>
        </div>
    </main>
    <footer>
        <nav class="navbar navbar-dark bg-dark">
            <div class="container-fluid text-light">
                <a href="https://heekdevelopment.com/" target="_blank">heekdevelopment.com</a>
            </div>
        </nav>
    </footer>
</body>
</html>