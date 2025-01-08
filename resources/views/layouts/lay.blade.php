<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Javadwipa Admin</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

    <style>
        .navbar {
            background-color: #2265da;
            padding: 0.5rem 1rem;
        }

        .navbar-brand img {
            height: 40px;
            width: auto;
            object-fit: contain;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            padding: 1rem !important;
            transition: all 0.2s ease;
        }

        .nav-link:hover {
            color: #ffffff !important;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .nav-link i {
            margin-right: 0.5rem;
        }

        .navbar-nav .active {
            background-color: rgba(255, 255, 255, 0.1);
            color: #ffffff !important;
        }

        .time-display {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }

        .badge-notification {
            position: absolute;
            top: 0.25rem;
            right: 0.25rem;
            font-size: 0.65rem;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="/">
                Admin
            </a>


            <!-- Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Content -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <!-- Main Navigation -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/customers">
                            <i class="fas fa-users"></i>
                            Customers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/salesmans">
                            <i class="fas fa-chart-line"></i>
                            Salesman
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/orders">
                            <i class="fas fa-shopping-cart"></i>
                            Orders
                        </a>
                    </li>
                </ul>

                <!-- Right Side Items -->
                <div class="d-flex align-items-center">
                    <!-- Time -->
                    <div class="time-display d-none d-lg-block">
                        <i class="fas fa-clock me-1"></i>
                        <span id="timeDisplay">03:39:10 PM</span>
                    </div>

                    <!-- Notifications -->
                    <div class="position-relative px-3">
                        <a href="#" class="nav-link">
                            <i class="fas fa-bell fa-fw"></i>
                            <span class="badge bg-danger badge-notification">3+</span>
                        </a>
                    </div>

                    <!-- Messages -->
                    <div class="position-relative px-3">
                        <a href="#" class="nav-link">
                            <i class="fas fa-envelope fa-fw"></i>
                            <span class="badge bg-danger badge-notification">7</span>
                        </a>
                    </div>

                    <!-- User Menu -->
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i>
                            Pramadani
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw me-2"></i>Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
                                    @csrf
                                </form>
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw me-2"></i>Logout
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-4">
        <div class="container-fluid">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Prama 2025</div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js"></script>

    <script>
        // Update time display
        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            document.getElementById('timeDisplay').textContent = timeString;
        }

        setInterval(updateTime, 1000);
        updateTime();
    </script>
</body>
</html>
