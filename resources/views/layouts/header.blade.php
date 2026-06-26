<!DOCTYPE html>
<html>
<head>
    <title>Issue Tracker</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

<nav class="navbar navbar-dark bg-dark position-relative">
    <div class="container-fluid px-3 py-2">
        <a class="navbar-brand position-absolute start-50 translate-middle-x" href="{{ route('projects.index') }}">
           PRITECH - Issue Tracker
        </a>
          @auth
            <div class="dropdown text-white ms-auto">

                <a class="text-white dropdown-toggle text-decoration-none"
                   href="#"
                   role="button"
                   data-bs-toggle="dropdown">

                    {{ Auth::user()->name }}
                </a>

                <ul class="dropdown-menu dropdown-menu-end">

                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item">
                                Logout
                            </button>
                        </form>
                    </li>

                </ul>
            </div>
        @endauth

        @guest
            <a href="{{ route('login') }}" class="btn btn-outline-light">
                Login
            </a>
        @endguest
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        @yield('content')
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>