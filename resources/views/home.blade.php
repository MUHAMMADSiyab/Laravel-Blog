@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        @php $rating = 3.4; @endphp

                        @foreach (range(1, 5) as $i)
                            <span class="fa-stack" style="width:2em">
                                <i class="far fa-star fa-stack-1x"></i>

                                @if ($rating > 0)
                                    @if ($rating > 0.5)
                                        <i class="fas fa-star fa-stack-1x"></i>
                                    @else
                                        <i class="fas fa-star-half fa-stack-1x"></i>
                                    @endif
                                @endif
                                @php $rating--; @endphp
                            </span>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
