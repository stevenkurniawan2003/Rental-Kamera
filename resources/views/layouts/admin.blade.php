<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Rental Kamera</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            overflow-x: hidden;
            background-color: #f8f9fa;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background: #2c3e50;
            color: white;
            transition: all 0.3s;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 20px;
            background: #1a252f;
        }

        .sidebar ul.components {
            padding: 20px 0;
        }

        .sidebar ul li a {
            padding: 12px 20px;
            color: white;
            display: block;
            text-decoration: none;
            transition: all 0.3s;
        }

        .sidebar ul li a:hover {
            background: #34495e;
            color: white;
        }

        .sidebar ul li.active > a {
            background: #4e73df;
            color: white;
        }

        .sidebar-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 20px;
            background: #1a252f;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            transition: all 0.3s;
            min-height: 100vh;
        }

        /* When sidebar is collapsed */
        .sidebar-collapsed .sidebar {
            width: 80px;
        }

        .sidebar-collapsed .sidebar .sidebar-text {
            display: none;
        }

        .sidebar-collapsed .main-content {
            margin-left: 80px;
        }

        /* Navbar */
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        /* Product Cards */
        .product-card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: all 0.3s;
            margin-bottom: 20px;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .product-img-container {
            height: 180px;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
        }

        .product-img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }

        .product-body {
            padding: 15px;
        }

        .product-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .product-category {
            font-size: 0.85rem;
            color: #6c757d;
            margin-bottom: 8px;
        }

        .product-price {
            font-size: 1rem;
            font-weight: 600;
            color: #28a745;
            margin-bottom: 10px;
        }

        .stock-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .in-stock {
            background-color: #d4edda;
            color: #155724;
        }

        .out-stock {
            background-color: #f8d7da;
            color: #721c24;
        }

        .action-btn {
            padding: 6px 12px;
            font-size: 0.85rem;
            border-radius: 5px;
        }
    </style>

    @yield('styles')
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
    <nav class="sidebar">
    <div class="sidebar-header p-3">
        <h4 class="mb-0 d-flex align-items-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" height="30" class="me-2">
            <span class="sidebar-text">Rental Kamera</span>
        </h4>
    </div>

    <ul class="list-unstyled components px-2">
        <li class="mb-1">
            <a href="/dashboard" class="d-flex align-items-center p-3 rounded active">
                <i class="fas fa-box fa-fw me-3" style="width: 20px; text-align: center"></i>
                <span class="sidebar-text">Manajemen Produk</span>
            </a>
        </li>

        <li class="mb-1">
            <a href="#" class="d-flex align-items-center p-3 rounded">
                <i class="fas fa-shopping-cart fa-fw me-3" style="width: 20px; text-align: center"></i>
                <span class="sidebar-text">Manajemen Penyewaan</span>
            </a>
        </li>

        <li class="mb-1">
            <a href="#" class="d-flex align-items-center p-3 rounded">
                <i class="fas fa-exchange-alt fa-fw me-3" style="width: 20px; text-align: center"></i>
                <span class="sidebar-text">Manajemen Pengambilan</span>
            </a>
        </li>

        <li class="mb-1">
            <a href="#" class="d-flex align-items-center p-3 rounded">
                <i class="fas fa-history fa-fw me-3" style="width: 20px; text-align: center"></i>
                <span class="sidebar-text">Riwayat</span>
            </a>
        </li>
    </ul>
</nav>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Navbar -->
            <nav class="navbar navbar-expand navbar-light bg-white shadow-sm">
                <div class="container-fluid">
                    <button class="btn btn-link" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>

                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-2"></i>
                                Admin
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <i class="fas fa-user me-2"></i>
                                        <span>Profil</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <i class="fas fa-cog me-2"></i>
                                        <span>Pengaturan</span>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="mb-0">
                                        @csrf
                                        <button type="submit" class="dropdown-item d-flex align-items-center w-100">
                                            <i class="fas fa-sign-out-alt me-2"></i>
                                            <span>Logout</span>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Page Content -->
            <div class="container-fluid p-4">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Sidebar Toggle
        $(document).ready(function() {
            $('#sidebarToggle').click(function() {
                $('.wrapper').toggleClass('sidebar-collapsed');
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
