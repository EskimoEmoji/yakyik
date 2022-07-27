@extends('layout')
@section('content')
{{--    CREATE POST--}}
    <div class="text-white mx-4">
        @include('.components.backButton')
        <form method="POST" action="/posts" class="mx-auto bg-gray-800 rounded-xl p-4 lg:w-1/4 md:w-1/2">
            @csrf
            <h1 class="text-2xl font-bold mb-4">New Yak</h1>
            <input class="input" type="text" name="text" placeholder="Yak something...">
            <div class="flex justify-end">
                <button type="submit" class="button px-4 py-1 rounded-xl mt-4">
                    Post
                </button>
            </div>
        </form>
    </div>
@endsection
