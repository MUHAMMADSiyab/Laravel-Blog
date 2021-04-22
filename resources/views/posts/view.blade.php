@extends('layouts.app')

@section('title') Posts @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <posts-view :posts="{{ json_encode($posts) }}" />
            </div>
        </div>
    </div>
@endsection
