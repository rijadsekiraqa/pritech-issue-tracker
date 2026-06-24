@extends('layouts.header')

@section('content')

<div class="row">

    @include('layouts.sidebar')

    <div class="col-md-10">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mt-3">Create Comment</h2>
            <a href="{{ route('comments.index') }}" class="btn btn-danger btn-sm mt-3 px-3 py-2">
            <i class="bi bi-arrow-left me-1"></i> Back
            </a>
        </div>
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf

                     <div class="mb-3">
                        <label class="form-label">Issue</label>
                        <select name="issue_id" class="form-select">
                            <option value="">Select Issue</option>
                            @foreach ($issues as $issue)
                                <option value="{{ $issue->id }}">
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
                            value="{{ old('author_name') }}"
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
                        >{{ old('body') }}</textarea>

                        @error('body')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-4">
                            Save Comment
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>

</div>

@endsection