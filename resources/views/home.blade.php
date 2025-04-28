<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Aplikasi Absensi</title>

    <!-- Bootstrap & Icons -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            background: linear-gradient(to right, #e0f7fa, #ffffff);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .sidebar {
            width: 250px;
            background: #007bff;
            color: #fff;
            padding-top: 30px;
            position: fixed;
            height: 100%;
        }

        .sidebar .brand {
            font-size: 1.5rem;
            text-align: center;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .sidebar a {
            color: #fff;
            padding: 15px 25px;
            display: block;
            transition: all 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #0056b3;
            text-decoration: none;
            border-left: 4px solid #fff;
        }

        .main {
            margin-left: 250px;
            flex-grow: 1;
        }

        .navbar-custom {
            background-color: #3399ff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link,
        .navbar-custom .dropdown-toggle {
            color: #fff !important;
        }

        .content {
            padding: 30px;
        }

        .card-custom {
            background: #ffffff;
            border: none;
            border-radius: 12px;
            box-shadow: 0px 4px 12px rgba(0, 123, 255, 0.1);
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="brand">ABSENSI</div>
            @if(auth()->user()->role == 'admin')
            <a href="{{ route('karyawan.index') }}"><i class="fas fa-user-plus mr-2"></i> Tambah Karyawan</a>
            <a href="{{ route('absensi.index') }}"><i class="fas fa-calendar-check mr-2"></i> Absensi</a>
            <a href="#"><i class="fas fa-calendar-alt mr-2"></i> Jadwal Kerja</a>
            @else
            <a href="{{ route('absensi.index') }}"><i class="fas fa-calendar-check mr-2"></i> Absensi</a>
            <a href="#"><i class="fas fa-calendar-alt mr-2"></i> Jadwal Kerja</a>
            @endif
        </div>

        <!-- Main Content -->
        <div class="main">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-custom">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ route('home') }}">Dashboard Aplikasi Absensi</a>
                    <div class="ml-auto">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user"></i> {{ Auth::user()->email }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item">Level: {{ Auth::user()->role }}</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('actionlogout') }}">
                                        <i class="fa fa-power-off"></i> Log Out
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Dynamic Content -->
            <div class="content">
                @yield('konten')
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>