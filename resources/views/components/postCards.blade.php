<div class="card lg:w-1/4 md:w-1/2 mx-auto mb-3 shadow-md">

    <a href="/posts/{{$post->id}}" class="">
        {{$post->text}}
        @include('.components.distanceTime')
    </a>
{{--     First Branch--}}

    {{--                COMMENTS--}}
    <div class="flex justify-between pt-3">
        <div><a href="/posts/{{$post->id}}">{{$post->comments->count()}} 💬</a></div>

        @include('.components.postVoting')
    </div>
</div>
