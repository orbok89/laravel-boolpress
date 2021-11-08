@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <article>
                    <h1>Vista Create Post</h1>
                    <form action="{{route('admin.posts.store')}}" method="post">
                        @csrf
                        @method('POST')

                        <div class="form-group">
                            <label for="title">Titolo</label>
                            <input value="{{old('title')}}" type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" >
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea   type="text" name="content" id="content" class="form-control  @error('content') is-invalid @enderror">{{old('content')}}
                            </textarea>
                            @error('content')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category_id">Categoria</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="">-- Seleziona la categoria --</option>
                                @foreach ($categories as $category)
                                
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : null }} >{{ $category->name }}</option>
                             @endforeach
                            </select>
                        </div>
                       

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Crea post</button>
                        </div>

                    </form>
                </article>
                
            </div>
        </div>
    </div>
@endsection