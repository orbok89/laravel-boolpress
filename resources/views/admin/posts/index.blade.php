@extends('layouts.dashboard')
@section('content')
    <a href="{{route('admin.posts.create' )}}">new post</a>
    <ul>
        @foreach ($posts as $post)
            <li><a href="{{route('admin.posts.show', $post['slug'])}}">{{$post['title']}} </a></li>
            <form method="post" action="{{route('admin.posts.destroy', $post->id)}}" class="d-inline-block">
            @csrf
            @method('DELETE')
            <button type="submit">DELETE</button>
            </form>
            <a href="{{route('admin.posts.edit', $post['slug'])}}">Edit</a>
        @endforeach
    </ul>
@endsection
 