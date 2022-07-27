@extends('layout')
@section('content')

        {{--    ALL POSTS--}}
        @forelse($posts as $post)

            @include('components.postCards')

            @if($loop->last)
                <div class="mb-48"></div>
            @endif
        @empty
            <div class="text-white text-xl text-center">
                <div class="mx-auto">Much Empty. Create a new post!</div>
            </div>
        @endforelse
    </div>

@endsection
