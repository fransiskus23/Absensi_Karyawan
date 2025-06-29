<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Aplikasi Absensi</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> {{-- Pastikan path ini benar --}}

    <style>
        /* Global Body/Background */
        body {
            margin: 0; /* Penting: hilangkan margin bawaan body */
            padding: 0; /* Hilangkan padding bawaan body */
            background-color: #f8f9fa;
            font-family: 'Montserrat', sans-serif;
            display: flex; /* Gunakan flexbox untuk mengisi seluruh tinggi viewport */
            min-height: 100vh; /* Pastikan body mengambil tinggi penuh viewport */
        }

        .wrapper {
            display: flex; /* Menggunakan Flexbox untuk sidebar dan main content */
            width: 100%; /* Memastikan wrapper mengambil lebar penuh */
        }

        .sidebar {
            width: 250px; /* Lebar tetap untuk sidebar */
            min-width: 250px; /* Penting agar tidak menyusut */
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 20px 0; /* Padding vertikal untuk isi sidebar */
            box-shadow: 2px 0 5px rgba(0,0,0,0.1); /* Sedikit bayangan di sisi kanan */
            /* Pastikan elemen di dalam sidebar tertata vertikal */
            display: flex;
            flex-direction: column;
            align-items: flex-start; /* Elemen ke kiri */
            height: 100vh; /* Sidebar mengambil tinggi penuh viewport */
            position: sticky; /* Agar sidebar tetap saat scroll, jika konten main panjang */
            top: 0; /* Posisikan di atas */
        }

        .sidebar .brand {
            font-size: 1.8rem;
            font-weight: bold;
            text-align: center;
            padding: 15px 20px;
            color: #ffffff;
            margin-bottom: 20px;
            width: 100%; /* Pastikan brand mengambil lebar penuh sidebar */
        }

        .sidebar a {
            display: block; /* Agar link mengambil baris penuh */
            color: #bdc3c7;
            padding: 10px 20px;
            text-decoration: none;
            transition: background-color 0.3s ease, color 0.3s ease;
            width: 100%; /* Agar link mengisi lebar sidebar */
        }

        .sidebar a:hover {
            background-color: #34495e;
            color: #ffffff;
        }
        .sidebar a.active { /* Jika Anda memiliki kelas 'active' untuk menu yang sedang aktif */
            background-color: #1abc9c;
            color: #ffffff;
            border-radius: 0 5px 5px 0; /* Hanya sisi kanan yang membulat */
        }

        .main {
            flex-grow: 1; /* Konten utama mengambil sisa ruang yang tersedia */
            display: flex; /* Untuk menata navbar dan content secara vertikal */
            flex-direction: column;
        }

        .navbar-custom {
            background-color: #ffffff; /* Warna navbar di atas konten utama */
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Bayangan lembut untuk navbar */
            padding: 15px 30px; /* Tambah padding */
        }

        .navbar-custom .navbar-brand {
            font-weight: bold;
            color: #333; /* Warna teks brand */
        }

        .navbar-custom .nav-link {
            color: #555;
        }

        .navbar-custom .nav-link.dropdown-toggle {
            display: flex;
            align-items: center;
        }

        .navbar-custom .nav-link .fa-user {
            margin-right: 8px; /* Jarak antara ikon user dan email */
        }

        .content {
            flex-grow: 1; /* Konten mengambil sisa ruang vertikal di 'main' */
            padding: 30px; /* Padding di sekitar konten dashboard */
            overflow-y: auto; /* Jika konten terlalu panjang, bisa di-scroll */
        }

        /* --- Dashboard Card Styling (dari sebelumnya, pastikan ini masih ada) --- */
        .dashboard-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            min-height: 120px;
            transition: transform 0.3s ease;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
        }
        .dashboard-card .card-body {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 25px;
        }
        .dashboard-card .card-title {
            font-size: 0.9rem;
            font-weight: 500;
            opacity: 0.8;
            margin-bottom: 5px !important;
        }
        .dashboard-number {
            font-size: 2.8rem;
            font-weight: bold;
            line-height: 1;
            margin: 0;
        }
        .dashboard-icon {
            font-size: 3.5rem !important;
            opacity: 0.3;
        }

        /* Specific Card Colors */
        .dashboard-card.bg-primary { background: linear-gradient(45deg, #4A90E2, #6A5ACD); }
        .dashboard-card.bg-success { background: linear-gradient(45deg, #28a745, #218838); }
        .dashboard-card.bg-danger { background: linear-gradient(45deg, #dc3545, #c82333); }
        .dashboard-card.bg-warning { background: linear-gradient(45deg, #ffc107, #e0a800); }

        /* Responsiveness for smaller screens */
        @media (max-width: 768px) {
            .sidebar {
                width: 80px; /* Sidebar lebih kecil di layar mobile */
                min-width: 80px;
                /* Atur ulang posisi agar tidak overlay, misal: */
                /* position: fixed; */
                /* top: 0; */
                /* left: 0; */
                /* z-index: 1000; */
            }
            .sidebar .brand {
                font-size: 1.2rem;
                padding: 15px 5px;
            }
            .sidebar a {
                padding: 10px 5px;
                text-align: center;
                font-size: 0.75rem; /* Teks menu lebih kecil */
            }
            .sidebar a .mr-2 { /* Sembunyikan teks di samping ikon */
                display: none;
            }
            .sidebar a i {
                margin-right: 0 !important; /* Hilangkan margin ikon */
                display: block; /* Agar ikon di tengah */
                margin-bottom: 5px;
            }
            .main {
                margin-left: 80px; /* Geser konten utama sesuai lebar sidebar baru */
            }
            .navbar-custom {
                padding: 10px 15px;
            }
            .content {
                padding: 20px 15px;
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
            <a href="{{ route('jadwal.index') }}"><i class="fas fa-calendar-alt mr-2"></i> Jadwal Kerja</a>
            @else
            <a href="{{ route('absensi.index') }}"><i class="fas fa-calendar-check mr-2"></i> Absensi</a>
            <a href="{{ route('jadwal.index') }}"><i class="fas fa-calendar-alt mr-2"></i> Jadwal Kerja</a>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
