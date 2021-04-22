@extends('layouts.app')

@section('title') {{ $post->title }} @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>{{ $post->title }}</h2>
                <span class="d-block text-muted mb-2">{{ $post->formatted_date }}</span>

                <video src="/storage/posts/{{ $post->video }}" class="w-100" controls></video>

                <p class="text-justify">
                    {{ $post->description }}
                </p>
            </div>
        </div>
    </div>
@endsection
