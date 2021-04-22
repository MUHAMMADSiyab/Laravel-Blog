@extends('layouts.app')

@section('title') Add a Post @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create a New Post') }}</div>

                    <div class="card-body">
                        <post-add-form />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
