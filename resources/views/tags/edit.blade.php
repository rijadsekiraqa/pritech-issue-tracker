*@extends('layouts.header')

@section('content')

<div class="row">

    @include('layouts.sidebar')

    <div class="col-md-10">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mt-3">Edit Tag</h2>

            <a href="{{ route('tags.index') }}" class="mt-3 btn btn-danger btn-sm px-3 py-2">
                ← Back
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                <form action="{{ route('tags.update', $tag) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Name *</label>
                        <input type="text"
                               name="name"
                               value="{{ old('name', $tag->name) }}"
                               class="form-control">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                            <label class="form-label">Color</label>
                            <input type="color" name="color" value="{{ $tag->color }}" class="form-control form-control-color">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-4">
                            Update Tag
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>

</div>

@endsection