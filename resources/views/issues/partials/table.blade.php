<table class="table table-striped mb-0">
    <thead class="table-dark">
        <tr>
            <th>Title</th>
            <th>Description</th>
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
                <td>{{ $issue->description }}</td>
                <td>{{ $issue->project->name ?? '-' }}</td>

                <td>
                    <span class="badge
                        @if ($issue->status == 'open') bg-success
                        @elseif($issue->status == 'in_progress') bg-warning
                        @else bg-secondary @endif">
                        {{ ucfirst($issue->status) }}
                    </span>
                </td>

                <td>
                    <span class="badge
                        @if ($issue->priority == 'high') bg-danger
                        @elseif($issue->priority == 'medium') bg-warning
                        @else bg-info @endif">
                        {{ ucfirst($issue->priority) }}
                    </span>
                </td>

                <td>{{ $issue->due_date ?? '-' }}</td>

                <td>
                    <a href="{{ route('issues.show', $issue) }}" class="btn btn-primary btn-sm">
                        View
                    </a>

                    <a href="{{ route('issues.edit', $issue) }}" class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <form action="{{ route('issues.destroy', $issue) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this issue?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center text-muted p-4">
                    No issues found
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-3">
    {{ $issues->links() }}
</div>