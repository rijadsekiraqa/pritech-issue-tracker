@extends('layouts.header')

@section('content')

<div class="row">

    @include('layouts.sidebar')

    <div class="col-md-10">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Edit Project</h2>

            <a href="{{ route('projects.index') }}" class="btn btn-secondary btn-sm">
                ← Back
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                <form action="{{ route('projects.update', $project) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Name *</label>
                        <input type="text"
                               name="name"
                               value="{{ old('name', $project->name) }}"
                               class="form-control">

                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description"
                                  class="form-control"
                                  rows="4">{{ old('description', $project->description) }}</textarea>

                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Start Date</label>
                            <input type="date"
                                   name="start_date"
                                   value="{{ old('start_date', $project->start_date) }}"
                                   class="form-control">

                            @error('start_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Deadline</label>
                            <input type="date"
                                   name="deadline"
                                   value="{{ old('deadline', $project->deadline) }}"
                                   class="form-control">

                            @error('deadline')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-4">
                            Update Project
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>

</div>

@endsection