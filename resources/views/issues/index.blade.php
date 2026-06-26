@extends('layouts.header')

@section('content')
    <div class="row">
        @include('layouts.sidebar')
        <div class="col-md-10">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="mt-3">Issues</h2>
                <a href="{{ route('issues.create') }}" class="mt-3 btn btn-sm btn-danger px-3 py-2">
                    <i class="bi bi-plus-lg me-1"></i>Create
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success" id="success-alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card shadow-sm mb-3">
                <div class="card-header bg-light">
                    <strong>Filters</strong>
                </div>

                <div class="card-body">
                    <form method="GET" action="{{ route('issues.index') }}">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Search</label>
                                <input type="text" name="search" id="issue-search" class="form-control"
                                    placeholder="Search title or description..." value="{{ request('search') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Status</label>
                                <select name="status" class="form-select">
                                    <option value="">All Statuses</option>
                                    <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>
                                        Open
                                    </option>
                                    <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>
                                        In Progress
                                    </option>
                                    <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>
                                        Closed
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Priority</label>
                                <select name="priority" class="form-select">
                                    <option value="">All Priorities</option>
                                    <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>
                                        Low
                                    </option>
                                    <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>
                                        Medium
                                    </option>
                                    <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>
                                        High
                                    </option>
                                </select>
                            </div>


                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Tag</label>
                                <select name="tag_id" class="form-select">
                                    <option value="">All Tags</option>

                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}"
                                            {{ request('tag_id') == $tag->id ? 'selected' : '' }}>
                                            {{ $tag->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-funnel me-1"></i> Filter
                                    </button>

                                    <a href="{{ route('issues.index') }}" class="btn btn-outline-secondary">
                                        Reset
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div id="issues-table">
                @include('issues.partials.table', ['issues' => $issues])
            </div>
            
        </div>
    </div>
    <script>
        let searchTimer;
        document.getElementById('issue-search').addEventListener('keyup', function() {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(() => {
                const search = this.value;
                const status = document.querySelector('select[name="status"]').value;
                const priority = document.querySelector('select[name="priority"]').value;

                const params = new URLSearchParams({
                    search: search,
                    status: status,
                    priority: priority,
                });

                fetch(`{{ route('issues.index') }}?${params.toString()}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('issues-table').innerHTML = html;
                    });
            }, 1500);
        });
    </script>

    <script>
        setTimeout(() => {
            document.getElementById('success-alert')?.remove();
        }, 3000);
    </script>
@endsection
   
