<header class="w-full bg-green-300 mb-3 py-4">
    <div class="flex w-1/3 mx-auto">
        <h1 class="mx-auto text-3xl"><a href="/posts">YakYik</a></h1>
    </div>
    <div class="flex">
        <div class="w-1/3"></div>

        <div class="w-1/3 flex justify-center mt-3  ">
            @auth()
                @if(url()->current() !== 'http://localhost:3000/post/create')
                    <a class="bg-green-400 hover:bg-green-500 font-bold rounded px-3 py-1 border border-gray-800"href="/post/create">New Post</a>
                @endif
            @endauth
        </div>


        <div class="flex justify-end w-1/3 pr-10">
            @if(!auth()->user())
                <a class="mx-2"href="/register">Register</a>
                <a class="mx-2" href="/login">Login</a>
            @endif

            @auth()
                <div class="mr-10 font-bold">Hey, {{auth()->user()->name}}</div>

                <form id="logout-form" action="/logout" method="POST" class="logout">
                    @csrf
                    <button type="submit">
                        Logout
                    </button>
                </form>
            @endauth
        </div>
    </div>
</header>
