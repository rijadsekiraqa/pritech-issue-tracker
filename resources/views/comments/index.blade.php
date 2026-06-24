@extends('layouts.header')

@section('content')
    <div class="row">

        @include('layouts.sidebar')

        <div class="col-md-10">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="mt-3">Comments</h2>
                <a href="{{ route('comments.create') }}" class="mt-3 btn btn-sm btn-danger px-3 py-2">
                     <i class="bi bi-plus-lg me-1"></i>Create
                </a>
            </div>

            @if(session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>
            @endif

            <div class="table-responsive">

                <table class="table table-bordered table-striped mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th>Issue</th>
                            <th>Author</th>
                            <th>Comment</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($comments as $comment)
                            <tr>
                                <td>{{ $comment->issue->title }}</td>
                                <td>{{ $comment->author_name }}</td>
                                <td>{{ $comment->body }}</td>
                                <td>
                                    <a href="{{ route('comments.show', $comment) }}" class="btn btn-sm btn-primary">
                                        View
                                    </a>

                                    <a href="{{ route('comments.edit', $comment) }}" class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>

        </div>

    </div>
@endsection



    <script>
        setTimeout(() => {
            document.getElementById('success-alert')?.remove();
        }, 3000);
    </script>