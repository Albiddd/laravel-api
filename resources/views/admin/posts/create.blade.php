@extends('layouts.app')

@section('metaTitle', 'Add Post')

@section('content')



    <div class="container">
        <h1 class="font-weight-bolder">Crea nuovo post</h1>
        <div class="row">
            <div class="col-12">
                <form action="{{ route('admin.posts.store') }}" method="POST">

                    @csrf

                    <div class="form-group">
                        <label for="title" class="font-weight-bold">Titolo</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            value="{{ old('title') }}" name="title" placeholder="Inserisci il titolo del post.">
                        @error('title')
                            <div id="title" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content" class="font-weight-bold">Contenuto</label>
                        <textarea class="form-control" id="content" name="content" rows="20" placeholder="Inserisci il contenuto del post" required @error('content') is-invalid @enderror>{{ old('content') }}</textarea>
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
