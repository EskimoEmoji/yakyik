@extends('layout')
@section('content')
{{--    SHOWS SINGLE POST & COMMENTS--}}
    <div class="mx-4 h-full">

        @include('.components.backButton')
        <div class="card lg:w-1/4 md:w-1/2 mx-auto mb-3">
            <div class="">
                <a href="" class="text-2xl">{{$post->text}}</a>
            </div>

            @include('.components.distanceTime')

{{--            # Comments & Up/Down Voting--}}
            <div class="flex justify-between pt-3">
                <div class="font-bold">{{$post->comments->count()}}
                    @if($post->comments->count() === 1)
                        Comment
                    @else
                        Comments
                    @endif
                </div>

                @include('.components.postVoting')
            </div>


{{--            COMMENT INPUT--}}
            <form method="POST" action="/posts/{{$post->id}}/comment" class="mx-auto rounded-xl py-4">
                @csrf
                <div class="flex">
                    <input class="rounded-tl rounded-bl text-black w-full pl-2" type="text" name="text" placeholder="comment...">
                    <button type="submit" class="button px-4 py-1 rounded-br rounded-tr">
                        Reply
                    </button>
                </div>
                @error('text')
                    <p class="text-red-500 text-xs mt-2">{{$message}}</p>
                @enderror
            </form>

{{--            COMMENTS--}}
            <div class="">
                @foreach($post->comments as $comment)
                    <div class="">
                        {{$comment->text}}
                    </div>


{{--                 COMMENT VOTING--}}
                    <div class="flex justify-between pt-3">
                        <div class="text-sm font-bold flex-end">
                            {{$comment->created_at->diffForHumans()}}
                        </div>
                        <div class="flex justify-center items-center">
                            <form action="/posts/{{$post->id}}/voted/-1/comment/{{$comment->id}}" method="POST">
                                @csrf
                                @method('PATCH')

                                @if($comment->didVoteOnComment())
                                    @if($comment->didVoteOnComment()->vote == -1)
                                        <button type="submit" class="text-green-300">∇</button>
                                    @else
                                        <button type="submit" class="">∇︎</button>
                                    @endif
                                @else
                                    <button type="submit" class="">∇</button>
                                @endif
                            </form>
                            <div class="px-2 font-bold text-sm">{{$comment->commentScore()}}</div>

                            {{--                        UP VOTE--}}
                            <form action="/posts/{{$post->id}}/voted/1/comment/{{$comment->id}}" method="POST">
                                @csrf
                                @method('PATCH')

                                @if($comment->didVoteOnComment())
                                    @if($comment->didVoteOnComment()->vote == 1)
                                        <button type="submit" class="text-green-300">∆︎</button>
                                    @else
                                        <button type="submit">∆︎</button>
                                    @endif
                                @else
                                    <button type="submit">∆︎</button>
                                @endif
                            </form>
                        </div>
                    </div>

                    @if($loop->last)<div></div>@else <div class="border-b my-2"></div>@endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="mb-48"></div>

@endsection
