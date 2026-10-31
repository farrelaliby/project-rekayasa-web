<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('admin_web_profile', 'Admin Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.8-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.8/css/dataTables.dataTables.min.css">
    <style>
    body {
        background-color: #f8f9fa;
    }

    .admin-sidebar {
        width: 250px;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        background-color: #343a40;
        color: #fff;
        /* Ubah padding-top dari 70px ke 100px atau 120px agar menu turun lebih kebawah */
        padding-top: 110px; 
        z-index: 1000;
    }

    .admin-sidebar .nav-link {
        color: #fff;
        padding: 12px 20px;
        font-weight: 500;
        margin-bottom: 5px; /* Memberi sedikit jarak antar menu */
    }

    .admin-sidebar .nav-link:hover,
    .admin-sidebar .nav-link.active {
        background-color: #495057;
        color: #fff;
        border-radius: 4px; /* Memberikan sudut tumpul halus pada menu aktif/hover */
    }

    .admin-content {
        margin-left: 250px;
        padding: 30px;
        margin-top: 60px;
        /* Perbaikan rumus calc() min-height */
        min-height: calc(100vh - 60px); 
        display: flex;
        flex-direction: column;
    }

    @media (max-width: 768px) {
        .admin-sidebar {
            width: 100%;
            position: relative;
            height: auto;
            padding-top: 20px;
        }

        .admin-content {
            margin-left: 0;
        }
    }
    </style>
</head>

<body>

    <!-- Navbar Atas -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-warning fixed-top shadow-sm px-3">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('gambar/logo.png') }}" alt="Logo" width="120" height="40" style="object-fit: contain;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-semibold" href="{{ route('home') }}" target="_blank">Lihat Website</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger fw-semibold" href="{{ route('contact') }}">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar Kiri -->
    <div class="admin-sidebar d-flex flex-column flex-shrink-0 p-3">
        <h4 class="text-white text-center mb-4">Panel Admin</h4>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item mb-1">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="{{ route('projects.index') }}" class="nav-link {{ request()->routeIs('projects.index') ? 'active' : '' }}">
                    Data Project
                </a>
            </li>
        </ul>
    </div>

    <!-- Content Utama -->
    <div class="admin-content">
        <div class="flex-grow-1">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="bg-dark text-white text-center py-3 mt-5 rounded">
            <div class="container">
                <p class="mb-0">&copy; 2026 MyProfile. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <!-- URUTAN JS YANG BENAR: jQuery -> Bootstrap -> DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.datatables.net/2.3.8/js/dataTables.min.js"></script>
    
    @yield('scripts')
</body>

</html>