@extends('blog.plantilla')

@section('content')
    @if (count($posts) > 0)
        @foreach ($posts as $post)
        {{ $post->title }} <br>

        @endforeach
    @else
        <h4>There are no posts here!</h4>
    @endif
@endsection
