@extends('layout')
@section('content')
    <div class="text-white">
        <form method="POST" action="/posts" class="mx-auto bg-gray-800 rounded-xl p-4 lg:w-1/4">
            @csrf
            <h1 class="text-2xl font-bold mb-4">New Yak</h1>
            <input class="rounded text-black w-full" type="text" name="text" placeholder="Yak something...">
            <div class="flex justify-end">
                <button type="submit" class=" bg-green-300 text-black px-4 py-1 rounded-xl mt-4 hover:bg-green-500">
                    Post
                </button>
            </div>


        </form>
    </div>
@endsection
