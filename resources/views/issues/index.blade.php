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

                <div class="col-md-4">
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

                <div class="col-md-4">
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

                <div class="col-md-4">
                    <div class="d-flex gap-2">
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
                    <table class="table table-striped mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Title</th>
                                <th>Project</th>
                                <th>Status</th>
                                <th>Priority</th>
                                <th>Due Date</th>
                                <th width="200">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($issues as $issue)
                                <tr>
                                    <td>{{ $issue->title }}</td>

                                    <td>
                                        {{ $issue->project->name ?? '-' }}
                                    </td>

                                    <td>
                                        <span
                                            class="badge 
                                @if ($issue->status == 'open') bg-success
                                @elseif($issue->status == 'in_progress') bg-warning
                                @else bg-secondary @endif">
                                            {{ ucfirst($issue->status) }}
                                        </span>
                                    </td>

                                    <td>
                                        <span
                                            class="badge 
                                @if ($issue->priority == 'high') bg-danger
                                @elseif($issue->priority == 'medium') bg-warning
                                @else bg-info @endif">
                                            {{ ucfirst($issue->priority) }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $issue->due_date ?? '-' }}
                                    </td>

                                    <td>
                                        <a href="{{ route('issues.show', $issue) }}" class="btn btn-primary btn-sm">
                                            View
                                        </a>

                                        <a href="{{ route('issues.edit', $issue) }}" class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('issues.destroy', $issue) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Delete this issue?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted p-4">
                                        No issues found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

            <div class="mt-3">
                {{ $issues->links() }}
            </div>

        </div>
    @endsection


        <script>
        setTimeout(() => {
            document.getElementById('success-alert')?.remove();
        }, 3000);
    </script>