<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
{{--    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">--}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="background">
    <header class="w-full bg-green-300 mb-3 py-4">
        <div class="flex w-1/3 mx-auto">
            <h1 class="mx-auto text-3xl"><a href="/posts">YakYik</a></h1>
        </div>
        <div class="flex justify-end">
            @if(!auth()->user())
                <a class="mx-2"href="/register">Register</a>
                <a class="mx-2" href="/login">Login</a>
            @endif

            @auth()
                    <div class="mx-2">{{auth()->user()->name}}</div>

                <form id="logout-form" action="/logout" method="POST" class="logout">
                    @csrf
                    <button type="submit">
                        Logout
                    </button>
                </form>


            @endauth
        </div>

    </header>

    <div>
        @yield('content')
    </div>

    <footer class="w-full secondary fixed bottom-0">
        <div class="flex bg-green-400 w-1/3 mx-auto py-1">
            <h1 class="mx-auto text-2xl">YakYik Footer</h1>
        </div>
    </footer>
</body>
</html>
