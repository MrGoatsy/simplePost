<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Simple Post</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/autosize@4.0.2/dist/autosize.min.js"></script>
</head>
<body class="flex flex-col h-screen text-gray-200">
    <script>
        $(function() {
            autosize(document.querySelectorAll('textarea'))
        });
    </script>
    <nav class="p-6 bg-gray-800 flex justify-between">
        <ul class="flex items-center">
            <li><a href="{{ route('home') }}" class="p-3">Home</a></li>
            @auth
                <li><a href="{{ route('dashboard') }}" class="p-3">Dashboard</a></li>
            @endauth
            <li><a href="{{ route('posts') }}" class="p-3">Posts</a></li>
        </ul>
        <ul class="flex items-center">
            @auth
                <li><a href="{{route('users.posts', auth()->user()->username)}}" class="p-3">{{ auth()->user()->username }}</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="post" class="p-3 inline">
                        @csrf
                        <button>Logout</button>
                    </form>
                </li>
            @endauth
            @guest
                <li><a href="{{ route('register') }}" class="p-3">Register</a></li>
                <li><a href="{{ route('login') }}" class="p-3">Login</a></li>
            @endguest
        </ul>
    </nav>
    <main class="flex-grow bg-gray-600">
        @yield('content')
    </main>
    <footer class="p-6 bg-gray-800 flex">&copy;2021&nbsp;-&nbsp;<a href="https://heekdevelopment.com/" target="_blank">heekdevelopment.com</a></footer>
</body>
</html>