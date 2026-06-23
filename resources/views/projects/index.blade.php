@extends('layouts.header')

@section('content')
    <div class="row">

        @include('layouts.sidebar')

        <div class="col-md-10">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="mt-3">Projects</h2>
                <a href="{{ route('projects.create') }}" class="mt-3 btn btn-sm btn-danger px-3 py-2">
                     <i class="bi bi-plus-lg me-1"></i>Create
                </a>
            </div>

            @if(session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>
            @endif

            <div class="table-responsive">

                <table class="table table-bordered table-striped mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th>Name</th>
                            <th>Deadline</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($projects as $project)
                            <tr>
                                <td>
                                    <strong>{{ $project->name }}</strong>
                                </td>

                                <td>
                                    @if ($project->deadline)
                                        <span class="badge bg-secondary">
                                            {{ $project->deadline }}
                                        </span>
                                    @else
                                        <span class="text-muted">No deadline</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('projects.show', $project) }}" class="btn btn-sm btn-primary">
                                        View
                                    </a>

                                    <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <form action="{{ route('projects.destroy', $project) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>

        </div>

    </div>
@endsection



    <script>
        setTimeout(() => {
            document.getElementById('success-alert')?.remove();
        }, 3000);
    </script>