@extends('layout')
@section('content')
    <div class="mx-4">
        {{--    ALL POSTS--}}
        @foreach($posts as $post)
            <div class="card lg:w-1/4 md:w-1/2 mx-auto mb-3">
                <div class="">
                    <a href="/posts/{{$post->id}}" class="">{{$post->text}}</a>
                </div>

{{--                COMMENTS & VOTING--}}
                <div class="flex justify-between pt-3">
                    <div><a href="">{{$post->comments->count()}} 💬</a></div>
                    <div class="flex justify-center items-center">
                        <a href="">️⬇</a>
                        <div class="px-2 font-bold text-sm">{{$post->votes}}</div>
                        <a href="">⬆</a>
                    </div>
                </div>
            </div>

            @if($loop->last)<div class="mb-48"></div>@endif
        @endforeach

    </div>

@endsection
