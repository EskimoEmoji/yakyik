@extends('layout')
@section('content')
{{--    SHOWS SINGLE POST & COMMENTS--}}
    <div class="mx-4">
        <div class="bg-gray-900 text-white py-4 lg:w-1/4 md:w-1/2 mx-auto rounded-xl mb-3">
            <div class="mx-4">
                <a href="" class="text-2xl">{{$post->text}}</a>
            </div>

{{--            # Comments & Up/Down Voting--}}
            <div class="flex px-4 justify-between pt-3">
                <div class="font-bold">{{$post->comments->count()}} Comments</div>
                <div class="flex justify-center items-center">
                    <a href="">️⬇</a>
                    <div class="px-2 font-bold text-sm">{{$post->votes}}</div>
                    <a href="">⬆</a>
                </div>
            </div>


{{--            COMMENT INPUT--}}
            <form method="POST" action="/comments" class="mx-auto rounded-xl p-4">
                @csrf
                <div class="flex">
                    <input class="rounded-tl rounded-bl text-black w-full pl-2" type="text" name="text" placeholder="comment...">
                    <button type="submit" class=" bg-green-300 text-black px-4 py-1 rounded-br rounded-tr hover:bg-green-500">
                        Reply
                    </button>
                </div>

            </form>

{{--            COMMENTS--}}
            <div class="mx-4">
                @foreach($post->comments as $comment)
                    <div class="">
                        {{$comment->text}}
                    </div>
                    <div class="text-sm font-bold flex-end">
                        {{$comment->created_at->diffForHumans()}}
                    </div>

                    @if($loop->last)<div></div>@else <div class="border-b my-2"></div>@endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="mb-48"></div>

@endsection
