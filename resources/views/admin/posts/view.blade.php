@extends('admin.index', ['activePage' => 'posts', 'titlePage' => __('Manage Posts')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Manage Post</h4>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>S#</th>
                                            <th>Post Title</th>
                                            <th>Date</th>
                                            <th>Description (Summary)</th>
                                            <th>Author</th>
                                            <th>Comments</th>
                                            <th>Video</th>
                                            <th>Avg. Rating</th>
                                            <th>Actions</th>
                                        </tr>

                                    </thead>

                                    <tbody>
                                        @forelse ($posts as $post)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $post->title }}</td>
                                                <td>{{ $post->formatted_date }}</td>
                                                <td>{{ $post->summary }}</td>
                                                <td>{{ $post->user->name }}</td>
                                                <td>{{ count($post->comments) }}</td>
                                                <td>
                                                    <a href="/storage/posts/{{ $post->video }}" target="_blank">
                                                        <video class="embed-responsive embed-responsive-16by9"
                                                            style="width: 50px"
                                                            src="/storage/posts/{{ $post->video }}"></video>
                                                    </a>
                                                </td>
                                                <td>
                                                    <avg-rating :rating="{{ json_encode($post->avg_rating) }}">
                                                </td>
                                                <td class="actions d-print-none">
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="{{ route('admin.posts.edit', $post->id) }}"
                                                            class="btn btn-secondary">Edit</a>
                                                        <button class="btn btn-danger" onclick="event.preventDefault(); if (confirm('Are you sure?')) {
                                                                                    document.getElementById('delete-form-{{ $post->id }}').submit()
                                                                                }">
                                                            Delete
                                                        </button>

                                                        <form action="{{ route('admin.posts.delete', $post->id) }}"
                                                            method="post" id="delete-form-{{ $post->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No posts</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>


                            </div>

                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

</style>
