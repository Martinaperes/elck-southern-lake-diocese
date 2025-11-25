<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - {{ config('app.name') }}</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f6f7fb;
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #0d6efd;
            color: #fff;
            flex-shrink: 0;
        }
        .sidebar .nav-link {
            color: #fff;
            font-weight: 500;
            padding: 12px 20px;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: #0b5ed7;
            color: #fff;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            z-index: 1000;
        }
        .nav-item a {
            text-decoration: none;
        }
        footer {
            text-align: center;
            padding: 15px;
            color: #777;
            border-top: 1px solid #ddd;
            margin-top: 40px;
        }
    </style>
</head>

<body>
    {{-- Sidebar --}}
    <div class="sidebar d-flex flex-column p-3">
        <h4 class="text-center mb-4">{{ config('app.name') }}</h4>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ url('/admin') }}" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.events.index') }}" class="nav-link {{ request()->is('admin/events*') ? 'active' : '' }}">
                    <i class="bi bi-calendar-event me-2"></i> Events
                </a>
            </li>
            <li>
                <a href="{{ route('ministries.index') }}" class="nav-link">
                    <i class="bi bi-people me-2"></i> Ministries
                </a>
            </li>
            <li>
                <a href="#" class="nav-link">
                    <i class="bi bi-person-lines-fill me-2"></i> Members
                </a>
            </li>
        </ul>
        <hr>
        <div>
            <a href="{{ url('/') }}" class="nav-link text-white">
                <i class="bi bi-arrow-left-circle me-2"></i> Back to Site
            </a>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="content">
        {{-- Top Navbar --}}
        <nav class="navbar navbar-expand-lg navbar-light mb-4">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h5">Admin Panel</span>
                <div class="d-flex align-items-center">
                    <span class="me-3 text-muted">Hello, Admin</span>
                    <a href="#" class="btn btn-outline-danger btn-sm">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </div>
            </div>
        </nav>

        {{-- Page Content --}}
        <main>
            @yield('content')
        </main>

        <footer>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }} | Admin Dashboard</p>
        </footer>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
