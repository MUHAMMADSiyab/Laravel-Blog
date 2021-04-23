@extends('admin.index', ['activePage' => 'post_edit', 'titlePage' => __('Edit Post')])

@section('content')
    <div class="content">
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Post</h4>

                            <post-edit-form :post="{{ json_encode($post) }}" :admin="{{ json_encode(true) }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

</style>
