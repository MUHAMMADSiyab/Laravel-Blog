@extends('layouts.app')

@section('title') Edit a Post @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create a New Post') }}</div>

                    <div class="card-body">
                        <post-edit-form :post="{{ json_encode($post) }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
