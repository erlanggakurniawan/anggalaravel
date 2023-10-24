@extends('layouts.main')

@section('container')

    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <h1 class="justify-content-center mb-3">{{ $post->title }}</h1>
                
                <article class="my-3 fs-5">
                    {!! $post->body !!}
                </article>

            {{-- /posts diambil dari posts.blade/php --}}
            <a href="/posts" class="d-block mt-3 btn btn-success">Back to Post</a>

            </div>
        </div>
    </div>
        
@endsection