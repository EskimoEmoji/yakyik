@extends('layout')
@section('content')
    <div class="mx-4">
        <div class="mb-3 mx-auto lg:w-1/4 md:w-1/2 flex justify-end">
            <a class="button font-bold rounded px-3 py-1"href="/post/create">New Post</a>
        </div>
        {{--    ALL POSTS--}}
        @foreach($posts as $post)
            <div class="card lg:w-1/4 md:w-1/2 mx-auto mb-3">
                <div class="">
                    <a href="/posts/{{$post->id}}" class="">{{$post->text}}</a>
                </div>
                <div class="flex mt-2 text-sm">
                    @if($post->location !== null)
                        <div>~{{$post->distance(json_decode($post->location)->latitude,json_decode($post->location)->longitude)}}mi</div>
                    @endif
                    <div class="mx-2">|</div>
                    <div>{{ $post->created_at->diffForHumans()}}</div>
                </div>


{{--                COMMENTS & VOTING--}}
                <div class="flex justify-between pt-3">
                    <div><a href="/posts/{{$post->id}}">{{$post->comments->count()}} 💬</a></div>

{{--                    DELETE LATER--}}
                    <div class="mr-3">
                        @foreach($post->voters as $vote)
                            @if($vote->user_id === auth()->id() && $post->id === $vote->post_id)
                                <div>voted: {{$vote->vote}}</div>

                            @endif
                        @endforeach
                    </div>

                    <div class="flex justify-center items-center">
                        <form action="/posts/{{$post->id}}/voted/-1" method="POST">
                            @csrf
                            @method('PATCH')

                            <button type="submit">⬇</button>
                        </form>

                        <div class="px-2 font-bold text-sm">{{$post->votes}}</div>

                        <form action="/posts/{{$post->id}}/voted/1" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit">⬆</button>
                        </form>
                    </div>
                </div>
            </div>

            @if($loop->last)<div class="mb-48"></div>@endif
        @endforeach

    </div>

@endsection
