@extends('layout')
@section('content')
    <div class="mx-4">
        {{--    ALL POSTS--}}
        @foreach($posts as $post)

            @include('components.postCards')

            @if($loop->last)
                <div class="mb-48"></div>
            @endif
        @endforeach
    </div>

@endsection
