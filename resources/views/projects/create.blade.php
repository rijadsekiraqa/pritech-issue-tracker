@extends('layouts.header')

@section('content')

<div class="row">

    @include('layouts.sidebar')

    <div class="col-md-10">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mt-3">Create Project</h2>
            <a href="{{ route('projects.index') }}" class="btn btn-danger btn-sm mt-3 px-3 py-2">
            <i class="bi bi-arrow-left me-1"></i> Back
            </a>
        </div>
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('projects.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Start Date</label>
                            <input type="date" name="start_date" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Deadline</label>
                            <input type="date" name="deadline" class="form-control">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary px-4">
                            Save Project
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>

</div>

@endsection