@extends('layouts.app')

@section('metaTitle', 'Posts')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-8">
      <h1>Elenco di posts:</h1>
    </div>
    <div class="col-4 text-left d-flex justify-content-end align-items-center">
      <a href="{{ route('admin.posts.create') }}" type="button" class="btn btn-primary btn-sm">Nuovo Post</a>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-12">
      
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Slug</th>
            <th scope="col">Created at</th>
            <th colspan="2"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($posts as $post)
          <tr>
            <th scope="row">{{ $post->id }}</th>
            <td>{{ $post->title }}</td>
            <td>{{ $post->slug }}</td>
            <td>{{ $post->created_at }}</td>
            <td>
              <a href="{{ route('admin.posts.show',$post) }}" type="button" class="btn btn-secondary btn-sm">vedi</a>
            </td>
            <td>
              <form action="{{route('admin.posts.destroy', $post)}}" method="POST" class="d-inline-block" onsubmit="return confirm('Sei sicuro di voler cancellare il post?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" type="submit">Elimina</button>
              </form>
            </td>
          </tr>
              
          @endforeach
        
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection