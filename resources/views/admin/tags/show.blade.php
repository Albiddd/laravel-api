@extends('layouts.app')

@section('metaTitle', 'Tag: '. $tag->name )

@section('content')
    <div class="container my-5">
        <div class="row py-5">
            @foreach($tag->posts()->orderBy('title','asc')->limit(5)->get() as $post)
            <div class="col-8 m-auto bg-light p-5 border-bottom ">
                <p class="pt-3"><strong>Titolo Tag: </strong></p>
                <p class="pb-2">{{$tag->name}}</p>
                <p><strong>Slug: </strong></p>
                <p><em>{{$post->slug}}</em></p>
                <a class="btn btn-dark mt-4" href="{{route('admin.posts.index', compact('tag'))}}">Torna indietro</a>
            </div>
            @endforeach
        </div>
    </div>
@endsection