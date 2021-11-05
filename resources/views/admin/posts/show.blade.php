@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Visualizzazione post {{$post->id}}</h1>
                <h2>{{ $post->title }}</h2>
                <h2>{{ $post->content }}</h2>
                 

                <small>Lo slug è: {{ $post->slug }}</small>
            </div>
        </div>
    </div>
@endsection