@extends('layouts.app')
@section('content')
    @foreach ($posts as $post)
    <div class="card m-2" style="width: 18rem;">
        
        <div class="card-body">
        <h5 class="card-title">{{ $post->title }}</h5>
        
        <a href="{{route('posts.show', $post->slug)}}" class="btn btn-primary">Leggi l'articolo</a>
        </div>
    </div>
    @endforeach
    </div>
@endsection