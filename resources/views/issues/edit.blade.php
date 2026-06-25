@extends('layouts.header')

@section('content')
    <div class="row">

        @include('layouts.sidebar')

        <div class="col-md-10">

            <div class="d-flex justify-content-between align-items-center my-3">
                <h2>Edit Issue</h2>

                <a href="{{ route('issues.index') }}" class="mt-3 btn btn-danger btn-sm px-3 py-2">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            <div class="card">
                <div class="card-body">

                    <form action="{{ route('issues.update', $issue) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Project</label>
                            <select name="project_id" class="form-select">
                                <option value="">Select Project</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}"
                                        {{ old('project_id', $issue->project_id) == $project->id ? 'selected' : '' }}>
                                        {{ $project->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('project_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control"
                                value="{{ old('title', $issue->title) }}">
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" rows="4" class="form-control">{{ old('description', $issue->description) }}</textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="">Select status</option>
                                    <option value="open" {{ old('status', $issue->status) == 'open' ? 'selected' : '' }}>
                                        Open
                                    </option>
                                    <option value="in_progress"
                                        {{ old('status', $issue->status) == 'in_progress' ? 'selected' : '' }}>
                                        In Progress
                                    </option>
                                    <option value="closed"
                                        {{ old('status', $issue->status) == 'closed' ? 'selected' : '' }}>
                                        Closed
                                    </option>
                                </select>
                                @error('status')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Priority</label>

                                <select name="priority" class="form-select">
                                    <option value="">Select Priority</option>

                                    <option value="low"
                                        {{ old('priority', $issue->priority) == 'low' ? 'selected' : '' }}>
                                        Low
                                    </option>

                                    <option value="medium"
                                        {{ old('priority', $issue->priority) == 'medium' ? 'selected' : '' }}>
                                        Medium
                                    </option>

                                    <option value="high"
                                        {{ old('priority', $issue->priority) == 'high' ? 'selected' : '' }}>
                                        High
                                    </option>
                                </select>

                                @error('priority')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Due Date</label>
                                <input type="date" name="due_date" class="form-control" value="{{ $issue->due_date }}">
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary">
                            Update Issue
                        </button>

                    </form>

                </div>
            </div>

        </div>

    </div>
@endsection
