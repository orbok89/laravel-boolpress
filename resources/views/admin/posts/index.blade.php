@extends('layouts.dashboard')
@section('content')
    <ul>
        @foreach ($posts as $post)
            <li><a href="{{route('admin.posts.show', $post['id'])}}">{{$post['title']}} </a></li>
        @endforeach
    </ul>
@endsection