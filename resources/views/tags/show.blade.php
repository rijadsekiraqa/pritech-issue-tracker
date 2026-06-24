@extends('layouts.header')

@section('content')

<div class="row">

    @include('layouts.sidebar')

    <div class="col-md-10">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mt-3">Tag Details</h2>

            <a href="{{ route('tags.index') }}" class="btn btn-danger btn-sm px-3 py-2 mt-3">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
        </div>

        <div class="card shadow-sm mb-3">
            <div class="card-body">

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text"
                           class="form-control"
                           value="{{ $tag->name }}"
                           readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Color</label>
                    <div class="d-flex align-items-center gap-2">
                        <input type="color"
                               value="{{ $tag->color }}"
                               disabled>
                        <span>{{ $tag->color }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                <h5 class="mb-3">Issues using this Tag</h5>

                @if($tag->issues->count())
                    <ul class="list-group">
                        @foreach($tag->issues as $issue)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $issue->title }}</strong><br>
                                    <small class="text-muted">{{ $issue->status }}</small>
                                </div>

                                <span class="badge bg-secondary">
                                    {{ $issue->priority }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">No issues linked to this tag.</p>
                @endif

            </div>
        </div>

    </div>

</div>

@endsection