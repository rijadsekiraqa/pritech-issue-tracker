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
         <div class="rounded-3 overflow-hidden shadow-sm border">
            <div class="table-responsive">
                 <table class="table table-striped mb-0" style="border-collapse: collapse;">
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
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a href="{{ route('tags.edit', $tag) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form action="{{ route('tags.destroy', $tag) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            <i class="bi bi-trash"></i>
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

    </div>
@endsection



<script>
    setTimeout(() => {
        document.getElementById('success-alert')?.remove();
    }, 3000);
</script>
