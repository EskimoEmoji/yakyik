<div class="flex mt-2 text-sm">
    @if($post->location != null)
        <div>~{{$post->distance(json_decode($post->location)->latitude,json_decode($post->location)->longitude)}}mi</div>
    @endif
    <div class="mx-2">|</div>
    <div>{{ $post->created_at->diffForHumans()}}</div>
</div>
