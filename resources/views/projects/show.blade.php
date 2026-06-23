@extends('layouts.header')

@section('content')

<div class="row">

    @include('layouts.sidebar')

    <div class="col-md-10">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mt-3">Project Details</h2>

            <a href="{{ route('projects.index') }}" class="btn btn-danger btn-sm px-3 py-2 mt-3">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                <form>
                    <div class="mb-3">
                        <label class="form-label">
                            Name
                        </label>
                        <input type="text"
                               class="form-control"
                               value="{{ $project->name }}"
                               readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Description
                        </label>

                        <textarea class="form-control" rows="4" readonly>{{ $project->description }}</textarea>
                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                               Start Date
                            </label>

                            <input type="date"
                                   class="form-control"
                                   value="{{ $project->start_date }}"
                                   readonly>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Deadline
                            </label>

                            <input type="date"
                                   class="form-control"
                                   value="{{ $project->deadline }}"
                                   readonly>
                        </div>

                    </div>

                </form>

            </div>
        </div>

        <div class="card shadow-sm mt-4">

            <div class="card-header bg-white">
                <h5 class="mb-0">
                    Issues
                </h5>
            </div>

            <div class="card-body">

                @forelse ($project->issues as $issue)

                    <div class="border rounded p-3 mb-3">

                        <div class="d-flex justify-content-between align-items-start">

                            <h6 class="mb-1">
                                <i class="bi bi-exclamation-circle me-1"></i>
                                {{ $issue->title }}
                            </h6>

                            <div class="d-flex gap-2">

                                <span class="badge bg-primary">
                                    {{ $issue->status }}
                                </span>

                                <span class="badge bg-secondary">
                                    {{ $issue->priority }}
                                </span>

                            </div>

                        </div>

                        <p class="text-muted mb-0 mt-2">
                            {{ $issue->description }}
                        </p>

                    </div>

                @empty
                    <p class="text-muted mb-0">
                        No issues found for this project.
                    </p>
                @endforelse

            </div>

        </div>

    </div>

</div>

@endsection