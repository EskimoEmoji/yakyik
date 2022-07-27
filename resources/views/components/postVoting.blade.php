{{--                    Shows if voted. Need to fix--}}
<div class="mr-3">
    @foreach($post->voters as $vote)
{{--    If vote-user === current user && current Post == vote/post ID--}}
        @if($vote->user_id === auth()->id() && $post->id === $vote->post_id)
            <div>voted: {{$vote->vote}}</div>
        @endif
    @endforeach
</div>

{{--                    DOWN VOTE--}}
<div class="flex justify-center items-center">
    <form action="/posts/{{$post->id}}/voted/-1" method="POST">
        @csrf
        @method('PATCH')

        <button type="submit">⬇</button>
    </form>

    <div class="px-2 font-bold text-sm">{{$post->votes}}</div>

    {{--                        UP VOTE--}}
    <form action="/posts/{{$post->id}}/voted/1" method="POST">
        @csrf
        @method('PATCH')
        <button type="submit">⬆</button>
    </form>
</div>
