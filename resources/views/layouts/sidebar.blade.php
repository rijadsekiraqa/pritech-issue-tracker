<div class="col-md-2 bg-dark min-vh-100 p-3 text-white">

    <div class="mb-4">
        <small class="text-secondary">Management Panel</small>
    </div>

    <ul class="nav flex-column gap-2">

        <li class="nav-item">
            <a href="{{ route('dashboard') }}"
                class="nav-link text-white rounded px-3 py-2 {{ request()->routeIs('dashboard') ? 'bg-primary' : '' }}">
                   <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('projects.index') }}"
                class="nav-link text-white rounded px-3 py-2 {{ request()->routeIs('projects.*') ? 'bg-primary' : '' }}">
                  <i class="bi bi-folder2-open me-2"></i> Projects
            </a>
        </li>

         <li class="nav-item">
            <a href="{{ route('issues.index') }}"
                class="nav-link text-white rounded px-3 py-2 {{ request()->routeIs('issues.*') ? 'bg-primary' : '' }}">
                  <i class="bi bi-exclamation-triangle me-2"></i> Issues
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('tags.index') }}"
                class="nav-link text-white rounded px-3 py-2 {{ request()->routeIs('tags.*') ? 'bg-primary' : '' }}">
                  <i class="bi bi-tags me-2"></i> Tags
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('comments.index') }}"
                class="nav-link text-white rounded px-3 py-2 {{ request()->routeIs('comments.*') ? 'bg-primary' : '' }}">
                  <i class="bi bi-chat-dots me-2"></i> Comments
            </a>
        </li>


    </ul>

    <div class="mt-4 text-secondary small">
        © {{ date('Y') }} PRITECH
    </div>

</div>
