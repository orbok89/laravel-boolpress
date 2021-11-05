@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <article>
                    <h1>Modifica Post</h1>
                    <form action="{{route('admin.posts.update', $post->id)}}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="title">Titolo</label>
                            <input value="{{old('title', $post['title'])}}" type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" >
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea   type="text" name="content" id="content" class="form-control  @error('content') is-invalid @enderror">{{old('content',$post['content'])}}
                            </textarea>
                            @error('content')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Modifica post</button>
                        </div>

                    </form>
                </article>
                
            </div>
        </div>
    </div>
@endsection