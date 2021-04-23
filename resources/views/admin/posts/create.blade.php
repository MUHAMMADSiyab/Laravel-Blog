@extends('admin.index', ['activePage' => 'post_add', 'titlePage' => __('Add a Post')])

@section('content')
    <div class="content">
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Create Post</h4>

                            <post-add-form />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

</style>
