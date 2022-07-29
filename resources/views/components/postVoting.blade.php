{{--                    DOWN VOTE--}}
<div class="flex justify-center items-center">
    <form action="/posts/{{$post->id}}/voted/-1/post/0" method="POST">
        @csrf
        @method('PATCH')

{{--         ISSUEE--}}
        @if($post->didVoteOnPost())
            @if($post->didVoteOnPost()->vote == -1)
                <button type="submit" class="px-1">👎</button>
            @else
                <button type="submit" class="px-1">∇︎</button>
            @endif
        @else
            <button type="submit" class="px-1">∇</button>
        @endif
    </form>

    <div class="px-2 font-bold text-sm">{{$post->votes_sum_vote}}</div>

    {{--                        UP VOTE--}}
    <form action="/posts/{{$post->id}}/voted/1/post/0" method="POST">
        @csrf
        @method('PATCH')

        @if($post->didVoteOnPost())
            @if($post->didVoteOnPost()->vote == 1)
                <button type="submit" class="px-1">👍</button>
            @else
                <button type="submit" class="px-1">∆︎</button>
            @endif
        @else
            <button type="submit" class="px-1">∆︎</button>
        @endif
    </form>
</div>
