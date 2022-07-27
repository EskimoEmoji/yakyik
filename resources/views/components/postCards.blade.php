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


    {{--                COMMENTS--}}
    <div class="flex justify-between pt-3">
        <div><a href="/posts/{{$post->id}}">{{$post->comments->count()}} 💬</a></div>

        @include('.components.postVoting')
    </div>
</div>
