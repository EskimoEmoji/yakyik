<div class="mb-3 mx-auto lg:w-1/4 md:w-1/2">
    @if(url()->previous() !== url()->current())
        <a class="button font-bold rounded px-3 py-1"href="{{url()->previous()}}">Back</a>
    @else
        <a class="button font-bold rounded px-3 py-1"href="/posts">Back</a>
    @endif
</div>
