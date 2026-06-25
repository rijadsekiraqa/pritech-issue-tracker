@extends('layouts.header')

@section('content')
    <div class="row">

        @include('layouts.sidebar')

        <div class="col-md-10">

            <div class="d-flex justify-content-between align-items-center my-3">
                <h2>Issue Details</h2>

                <a href="{{ route('issues.index') }}" class="btn btn-danger btn-sm px-3 py-2">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            <div class="card mb-3">
                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label">Project</label>
                        <input type="text" class="form-control" value="{{ $issue->project->name ?? '-' }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" value="{{ $issue->title }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" rows="4" readonly>{{ $issue->description }}</textarea>
                    </div>

                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Status</label>
                            <input type="text" class="form-control" value="{{ ucfirst($issue->status) }}" readonly>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Priority</label>
                            <input type="text" class="form-control" value="{{ ucfirst($issue->priority) }}" readonly>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Due Date</label>
                            <input type="date" class="form-control" value="{{ $issue->due_date }}" readonly>
                        </div>

                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tags</label>

                        <div id="tags-container" class="mb-2">
                            @forelse($issue->tags as $tag)
                                <span class="badge bg-primary me-1 tag-item" style="cursor:pointer"
                                    data-id="{{ $tag->id }}">
                                    {{ $tag->name }} ✕
                                </span>
                            @empty
                                <span class="text-muted" id="no-tags">No tags</span>
                            @endforelse
                        </div>

                        <div class="mt-2">
                            <select id="tag-select" class="form-select w-100" multiple>
                                @foreach ($tags as $tag)
                                    @if (!$issue->tags->contains($tag->id))
                                        <option value="{{ $tag->id }}">
                                            {{ $tag->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <button type="button" id="attach-tag-btn" class="btn btn-primary btn-sm mt-2">
                            Attach Tag
                        </button>
                    </div>

                </div>
            </div>

            <!-- COMMENTS -->
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Comments
                </div>

                <div class="card-body">
                    <form id="comment-form" class="mb-3">

                        @csrf

                        <input type="hidden" name="issue_id" value="{{ $issue->id }}">

                        <div class="mb-2">
                            <label class="form-label">Author Name</label>
                            <input type="text" name="author_name" class="form-control">
                            <small class="text-danger" id="author_error"></small>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Body</label>
                            <textarea name="body" class="form-control"></textarea>
                            <small class="text-danger" id="body_error"></small>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm">
                            Add Comment
                        </button>

                    </form>
                    <div id="comments-container">
                        <p class="text-muted">Loading comments...</p>
                    </div>

                    <div id="pagination-container" class="mt-3"></div>

                </div>
            </div>

        </div>

    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const issueId = @json($issue->id);

            const tagsContainer = document.getElementById('tags-container');
            const tagSelect = document.getElementById('tag-select');

            $('#tag-select').select2({
                placeholder: "Select tag",
                width: '90%',
                allowClear: true
            });

            // ======================
            // ATTACH TAG
            // ======================
            document.getElementById('attach-tag-btn').addEventListener('click', function() {
                const tagIds = $('#tag-select').val(); // array

                if (!tagIds || tagIds.length === 0) return;

                fetch(`/issues/${issueId}/tags`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            tag_ids: tagIds
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        document.getElementById('no-tags')?.remove();

                        $('#tag-select option:selected').each(function() {
                            const tagId = $(this).val();
                            const tagName = $(this).text().trim();

                            tagsContainer.insertAdjacentHTML('beforeend', `
                            <span class="badge bg-primary tag-item me-1" data-id="${tagId}" style="cursor:pointer;">
                                ${tagName} &times;
                            </span>
                         `);
                            $(this).remove();
                        });
                        $('#tag-select').val(null).trigger('change');
                    })
                    .catch(err => console.log(err));
            });


            // ======================
            // DETACH TAG (event delegation)
            // ======================
            tagsContainer.addEventListener('click', function(e) {

                const tagEl = e.target.closest('.tag-item');
                if (!tagEl) return;

                const tagId = tagEl.dataset.id;

                fetch(`/issues/${issueId}/tags/${tagId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        }
                    })
                    .then(res => res.json())
                    .then(data => {

                        // remove from UI
                        tagEl.remove();

                        // restore dropdown option
                        const option = document.createElement('option');
                        option.value = data.tag.id;
                        option.text = data.tag.name;
                        tagSelect.appendChild(option);

                        // show empty state if needed
                        if (tagsContainer.querySelectorAll('.tag-item').length === 0) {
                            tagsContainer.innerHTML =
                                '<span class="text-muted" id="no-tags">No tags</span>';
                        }

                    })
                    .catch(err => console.log(err));
            });

        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const issueId = @json($issue->id);
            let currentPage = 1;

            function loadComments(page = 1) {

                fetch(`/issues/${issueId}/comments?page=${page}`)
                    .then(res => res.json())
                    .then(data => {

                        const container = document.getElementById('comments-container');
                        const pagination = document.getElementById('pagination-container');

                        let html = '';

                        if (!data.data || data.data.length === 0) {
                            html = '<p class="text-muted">No comments yet</p>';
                        } else {
                            data.data.forEach(comment => {
                                html += `
                                <div class="card mb-2 shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title mb-1">
                                            ${comment.author_name}
                                        </h6>

                                        <p class="card-text mb-0">
                                            ${comment.body}
                                        </p>
                                    </div>
                                </div>
                            `;
                            });
                        }

                        container.innerHTML = html;

                        // 🔥 PAGINATION UI
                        let pagHtml = '';

                        if (data.last_page > 1) {

                            pagHtml += `<nav><ul class="pagination">`;

                            // Prev
                            pagHtml += `
                            <li class="page-item ${data.current_page === 1 ? 'disabled' : ''}">
                                <a class="page-link"
                                href="#"
                                onclick="changePage(${data.current_page - 1}); return false;">
                                Previous
                                </a>
                            </li>
                        `;

                            // Page numbers
                            for (let i = 1; i <= data.last_page; i++) {
                                pagHtml += `
                            <li class="page-item ${i === data.current_page ? 'active' : ''}">
                                <a class="page-link"
                                href="#"
                                onclick="changePage(${i}); return false;">
                                ${i}
                                </a>
                            </li>
                        `;
                            }

                            // Next
                            pagHtml += `
                            <li class="page-item ${data.current_page === data.last_page ? 'disabled' : ''}">
                                <a class="page-link"
                                href="#"
                                onclick="changePage(${data.current_page + 1}); return false;">
                                Next
                                </a>
                            </li>
                        `;

                            pagHtml += `</ul></nav>`;
                        }

                        pagination.innerHTML = pagHtml;

                        currentPage = data.current_page;
                    });
            }

            // global function për buttons
            window.changePage = function(page) {
                loadComments(page);
            }

            loadComments();

            // POST comment
            document.getElementById('comment-form').addEventListener('submit', function(e) {
            e.preventDefault();

            document.getElementById('author_error').innerText = '';
            document.getElementById('body_error').innerText = '';

            let formData = new FormData(this);

            fetch(`/issues/${issueId}/comments`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                            'Accept': 'application/json'
                    },
                    body: formData
                })
            .then(async response => {
                let data = await response.json();

                if (!response.ok) {
                    throw data;
                }

                return data;
            })
            .then(data => {
                this.reset();
                loadComments(1);
            })
            .catch(error => {
                if (error.errors) {
                    document.getElementById('author_error').innerText =
                        error.errors.author_name?.[0] || '';

                    document.getElementById('body_error').innerText =
                        error.errors.body?.[0] || '';
                }
            });
            });
            document.querySelectorAll('.tag-item').forEach(tag => {
                tag.addEventListener('click', function() {

                    const tagId = this.dataset.id;

                    fetch(`/issues/${issueId}/tags/${tagId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]')
                                    .value
                            }
                        })
                        .then(res => res.json())
                        .then(data => {

                            // remove from UI without reload
                            this.remove();

                            // show empty state if needed
                            const container = document.getElementById('tags-container');

                            if (container.children.length === 0) {
                                container.innerHTML = '<span class="text-muted">No tags</span>';
                            }
                        })
                        .catch(err => console.log(err));
                });
            });

        });
    </script>
@endsection
