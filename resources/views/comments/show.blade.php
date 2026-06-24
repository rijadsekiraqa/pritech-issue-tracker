@extends('layouts.header')

@section('content')
    <div class="row">

        @include('layouts.sidebar')

        <div class="col-md-10">

            <div class="d-flex justify-content-between align-items-center my-3">
                <h2>Comment Details</h2>

                <a href="{{ route('comments.index') }}" class="btn btn-danger btn-sm px-3 py-2">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

                {{-- <div class="card-header bg-light">
                    Comments
                </div> --}}
        <div class="card mb-3">
                <div class="card-body">

                            <div class="mb-2">
                                <label class="form-label">Issue</label>
                                <input type="text" class="form-control" value="{{ $comment->issue->title ?? '-' }}" readonly>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Author</label>
                                <input type="text" class="form-control" value="{{ $comment->author_name }}" readonly>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Comment</label>
                                <textarea class="form-control" rows="3" readonly>{{ $comment->body }}</textarea>
                            </div>

                </div>
        </div>
        </div>

    </div>
@endsection
