@extends('layouts.header')

@section('content')
    <div class="row">

        @include('layouts.sidebar')

        <div class="col-md-10">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="mt-3">Tags</h2>
                <a href="{{ route('tags.create') }}" class="mt-3 btn btn-sm btn-danger px-3 py-2">
                    <i class="bi bi-plus-lg me-1"></i>Create
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success" id="success-alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">

                <table class="table table-bordered table-striped mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th>Name</th>
                            <th>Color</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($tags as $tag)
                            <tr>
                                <td>
                                    <strong>{{ $tag->name }}</strong>
                                </td>

                                <td>
                                    @if ($tag->color)
                                        <span
                                            style="
                                    display:inline-block;
                                    width:25px;
                                    height:25px;
                                    border-radius:4px;
                                    background-color: {{ $tag->color }};
                                    border:1px solid #ddd;">
                                        </span>
                                    @else
                                        <span class="text-muted">No color</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('tags.show', $tag) }}" class="btn btn-sm btn-primary">
                                        View
                                    </a>

                                    <a href="{{ route('tags.edit', $tag) }}" class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <form action="{{ route('tags.destroy', $tag) }}" method="POST" class="d-inline">
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
