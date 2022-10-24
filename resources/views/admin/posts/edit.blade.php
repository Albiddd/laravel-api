@extends('layouts.app')

@section('metaTitle', 'Edit: ' . $post->title)

@section('content')



    <div class="container">
        <h1 class="font-weight-bolder">Modifica post:</h1>
        <div class="row">
            <div class="col-12">
                <form action="{{ route('admin.posts.update', $post)}}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="title" class="font-weight-bold">Titolo</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            value="{{ old('title', $post->title )}}" name="title" placeholder="Inserisci il titolo del post.">
                        @error('title')
                            <div id="title" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="title" class="font-weight-bold">Categoria</label>
                        <select name="category_id" class="form-control @error('content') is-invalid @enderror">
                          <option value="" selected disabled hidden>Seleziona una categoria</option>
                          @foreach ($categories as $category)
                            <option @if(old('category_id',$post->category_id) == $category->id) selected @endif value="{{ $category->id }}">
                              {{ $category->name }}
                            </option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="title" class="font-weight-bold">Tags</label>
              
                        @foreach($tags as $key => $tag)
                          <div class="form-check form-check-inline">
                            <input  class="form-check-input" name="tags[]" @if( in_array($tag->id, old('tags', $post->tags->pluck('id')->all()) ) ) checked @endif type="checkbox" id="tag-{{$tag->id}}" value="{{ $tag->id }}">
                            <label class="form-check-label" for="tag-{{$tag->id}}">{{ $tag->name }}</label>
                          </div>
                        @endforeach
              
                      </div>

                    <div class="form-group">
                        <label for="content" class="font-weight-bold">Contenuto</label>
                        <textarea class="form-control" id="content" name="content" rows="20" placeholder="Inserisci il contenuto del post" required @error('content') is-invalid @enderror>{{ old('content', $post->content) }}</textarea>
                    </div>
                    @error('content')
                        <div id="content" class="invalid-feedback">
                            {{ $message }}
                        </div>
                     @enderror

                    <div class="buttons mt-4 d-flex justify-content-between align-items-center">
                        <a class="btn btn-dark shadow" href="{{route('admin.posts.index')}}">Torna indietro</a>
                        <button type="submit" class="btn btn-primary shadow">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection