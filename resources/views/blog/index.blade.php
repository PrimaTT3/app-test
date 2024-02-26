@extends('base')

@section('title', 'Acceuil du blog')

@section('content')


    <h1>Blog Test</h1>

    @foreach($posts as $post)
    <div class="row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <div class="card">
                @if($post->image)
                <img src="/storage/{{ $post->image }}" class="card-img-top" alt="...">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ $post->content }}</p>
                    <a href="{{ route('blog.show', ['slug' => $post->slug, 'post' => $post->id]) }}" class="btn btn-primary">Lire la suite</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    {{ $posts->links() }}

@endsection
