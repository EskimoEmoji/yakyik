{{--                    DOWN VOTE--}}
<div class="flex justify-center items-center">
    <form action="/posts/{{$post->id}}/voted/-1" method="POST">
        @csrf
        @method('PATCH')

        @if($post->didUserVote())
            @if($post->didUserVote()->vote == -1)
                <button type="submit" class="">👇</button>
            @else
                <button type="submit" class="">∇︎</button>
            @endif
        @else
            {{--            ∇--}}
            <button type="submit" class="">∇</button>
        @endif
    </form>

    <div class="px-2 font-bold text-sm">{{$post->score()}}</div>

    {{--                        UP VOTE--}}
    <form action="/posts/{{$post->id}}/voted/1" method="POST">
        @csrf
        @method('PATCH')

        @if($post->didUserVote())
            @if($post->didUserVote()->vote == 1)
                <button type="submit" class="">👆</button>
            @else
                <button type="submit" class="">∆︎</button>
            @endif
        @else
            <button type="submit" class="">∆︎</button>
        @endif
    </form>
</div>
