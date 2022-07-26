@extends('layout')
@section('content')
    <div class="mx-4">
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
                    <div><a href="">{{$post->comments->count()}} 💬</a></div>
                    <div class="flex justify-center items-center">
                        <form action="/posts/{{$post->id}}/voted/-1" method="POST">
                            @csrf
                            @method('PATCH')

                            <button type="submit">⬇</button>
                        </form>

                        <div class="px-2 font-bold text-sm">{{$post->votes}}</div>

                            <div>{{$post->myVotes}}</div>

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
