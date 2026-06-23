@extends('layouts.header')

@section('content')
<div class="row">

    @include('layouts.sidebar')

    <div class="col-md-10">

        <div class="d-flex justify-content-between align-items-center my-3">
            <h2>Issue Details</h2>

            <a href="{{ route('issues.index') }}" class="btn btn-danger btn-sm px-3 py-2">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
        </div>

        <div class="card mb-3">
            <div class="card-body">

                <div class="mb-3">
                    <label class="form-label">Project</label>
                    <input type="text" class="form-control" value="{{ $issue->project->name ?? '-' }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" value="{{ $issue->title }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" rows="4" readonly>{{ $issue->description }}</textarea>
                </div>

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Status</label>
                        <input type="text" class="form-control" value="{{ ucfirst($issue->status) }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Priority</label>
                        <input type="text" class="form-control" value="{{ ucfirst($issue->priority) }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Due Date</label>
                        <input type="date" class="form-control" value="{{ $issue->due_date }}" readonly>
                    </div>

                </div>

                <!-- TAGS -->
                <div class="mb-3">
                    <label class="form-label">Tags</label>
                    <div>
                        @forelse($issue->tags as $tag)
                            <span class="badge bg-primary me-1">
                                {{ $tag->name }}
                            </span>
                        @empty
                            <span class="text-muted">No tags</span>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>

        <!-- COMMENTS -->
        <div class="card">
            <div class="card-header bg-light">
                Comments
            </div>

            <div class="card-body">

                @forelse($issue->comments as $comment)
                    <div class="border-bottom mb-3 pb-2">
                        <strong>{{ $comment->author_name }}</strong>
                        <p class="mb-1">{{ $comment->body }}</p>
                    </div>
                @empty
                    <p class="text-muted">No comments yet</p>
                @endforelse

            </div>
        </div>

    </div>

</div>
@endsection