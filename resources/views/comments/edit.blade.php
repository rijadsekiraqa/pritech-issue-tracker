@extends('layouts.header')

@section('content')
<div class="row">

    @include('layouts.sidebar')

    <div class="col-md-10">

        <div class="d-flex justify-content-between align-items-center my-3">
            <h2>Edit Comment</h2>

            <a href="{{ route('comments.index') }}" class="btn btn-danger btn-sm px-3 py-2">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
        </div>

        <div class="card">
            <div class="card-body">

                <form action="{{ route('comments.update', $comment) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Issue</label>

                        <select name="issue_id" class="form-select">
                            <option value="">Select Issue</option>
                            @foreach ($issues as $issue)
                                <option value="{{ $issue->id }}"
                                    {{ old('issue_id', $comment->issue_id) == $issue->id ? 'selected' : '' }}>
                                    {{ $issue->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('issue_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Author Name</label>

                        <input
                            type="text"
                            name="author_name"
                            class="form-control"
                            value="{{ old('author_name', $comment->author_name) }}"
                        >

                        @error('author_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Body</label>

                        <textarea
                            name="body"
                            rows="5"
                            class="form-control"
                        >{{ old('body', $comment->body) }}</textarea>

                        @error('body')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Update Comment
                    </button>

                </form>

            </div>
        </div>

    </div>

</div>
@endsection