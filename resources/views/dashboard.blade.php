@extends('home')

@section('konten')
    <div class="row mb-4">
        <div class="col-md-4 col-sm-6 mb-3"> {{-- Tambah col-sm-6 untuk responsif lebih baik --}}
            <div class="card dashboard-card bg-primary text-white"> {{-- Ganti card-custom jadi dashboard-card, hilangkan mb-3 di sini karena di col-md-4 sudah ada mb-3 --}}
                <div class="card-body d-flex justify-content-between align-items-center"> {{-- Tambah d-flex untuk layout ikon dan teks --}}
                    <div>
                        <h5 class="card-title text-uppercase font-weight-normal mb-1">Jumlah Karyawan</h5> {{-- Perbaikan teks --}}
                        <h3 class="dashboard-number">{{ $jumlahKaryawan }}</h3> {{-- Tambah kelas untuk penekanan angka --}}
                    </div>
                    <i class="fas fa-users fa-3x dashboard-icon"></i> {{-- Naikkan ukuran ikon dan tambah kelas kustom --}}
                </div>
            </div>
        </div>

        @if(auth()->user()->role == 'admin')
            <div class="col-md-4 col-sm-6 mb-3">
                <div class="card dashboard-card bg-success text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title text-uppercase font-weight-normal mb-1">Jumlah Hadir</h5>
                            <h3 class="dashboard-number">{{ $jumlahCheckIn }}</h3>
                        </div>
                        <i class="fas fa-check fa-3x dashboard-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-3">
                <div class="card dashboard-card bg-danger text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title text-uppercase font-weight-normal mb-1">Jumlah Tidak Hadir</h5>
                            <h3 class="dashboard-number">{{ $jumlahTidakHadir }}</h3>
                        </div>
                        <i class="fas fa-times fa-3x dashboard-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-3">
                <div class="card dashboard-card bg-warning text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title text-uppercase font-weight-normal mb-1">Jumlah Check-Out</h5>
                            <h3 class="dashboard-number">{{ $jumlahCheckOut }}</h3>
                        </div>
                        <i class="fas fa-sign-out-alt fa-3x dashboard-icon"></i>
                    </div>
                </div>
            </div>
        @else
            <div class="col-md-4 col-sm-6 mb-3">
                <div class="card dashboard-card bg-success text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title text-uppercase font-weight-normal mb-1">Jumlah Hadir Bulan Ini</h5>
                            <h3 class="dashboard-number">{{ $jumlahHadir }}</h3>
                        </div>
                        <i class="fas fa-check fa-3x dashboard-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-3">
                <div class="card dashboard-card bg-danger text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title text-uppercase font-weight-normal mb-1">Jumlah Tidak Hadir Bulan Ini</h5>
                            <h3 class="dashboard-number">{{ $jumlahTidakCheckIn }}</h3>
                        </div>
                        <i class="fas fa-times fa-3x dashboard-icon"></i>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
