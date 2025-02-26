@extends('layouts.main')

@section('container')

<h1 class="mb-3 text-center">{{ $tittle }}</h1> 

<div class="row justify-content-center mb-3">
    <div class="col-md-6">
        <form action="/posts">
            @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            @if(request('author'))
                <input type="hidden" name="author" value="{{ request('author') }}">
            @endif
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search.." name="search" value="{{ request('search') }}">
                <button class="btn btn-info text-white" type="submit">Search</button>
            </div>
        </form>
    </div>
</div>

@if($posts->count())

<div class="card mb-3">
  <img src="https://source.unsplash.com/1200x400?{{ $posts[0]->category->name }}" class="card-img-top" alt="{{ $posts[0]->category->name }}">
  <div class="card-body text-center">
    <h3 class="card-title"><a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none text-dark">{{ $posts[0]->title }}</a></h3>
    <p>
        <small class="text-muted">
            By. <a href="/posts?author={{ $posts[0]->author->username }}" class="text-decoration-none text-primary">{{  $posts[0]->author->name }}</a> in <a href="/posts?category={{  $posts[0]->category->slug }}" class="text-decoration-none text-primary">{{ $posts[0]->category->name }}</a> posted on {{ $posts[0]->created_at->format('d F Y') }}<p/>
        </small> 
    </p> 
    <p class="card-text">{{ $posts[0]->excerpt }}
    <br><br>
    <a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none btn btn-info text-white">Read more</a>
  </div>
</div>

    <div class="row pb-5">
        @foreach($posts->skip(1) as $post)
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="position-absolute px-3 py-2" style="background-color: rgba(0, 0, 0, 0.5)" >
                    <a href="/posts?category={{  $post->category->slug }}" class="text-white text-decoration-none">{{ $post->category->name }}</a>
                </div>
                <img src="https://source.unsplash.com/500x400?{{ $post->category->name }}" class="card-img-top" alt="{{ $post->category->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p>
                        <small class="text-muted">
                            By. <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none text-primary">{{  $post->author->name }}</a> posted on {{ $post->created_at->format('d F Y') }}<p/>
                        </small>
                    </p> 
                    <p class="card-text">{{ $post->excerpt }}</p>
                    <a href="/posts/{{ $post->slug }}" class="btn btn-info text-white">Read more</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

@else

<p class="text-center fs-4">No Post Found</p>

@endif

<div class="d-flex justify-content-center" style="">
    {{ $posts->links() }}
</div>

@endsection