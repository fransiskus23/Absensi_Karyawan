@extends('home')

@section('konten')
<div class="row mb-4">
    <!-- Card: Jumlah Karyawan -->
    <div class="col-md-4">
        <div class="card card-custom text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Jumlah Karyawan</h5>
                <h3>{{ $jumlahKaryawan }}</h3>
                <i class="fas fa-users fa-2x float-right"></i>
            </div>
        </div>
    </div>

    @if(auth()->user()->role == 'admin')
    <!-- Admin's Dashboard: Kehadiran -->
    <div class="col-md-4">
        <div class="card card-custom text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Jumlah Hadir</h5>
                <h3>{{ $jumlahCheckIn }}</h3>
                <i class="fas fa-check fa-2x float-right"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-custom text-white bg-danger mb-3">
            <div class="card-body">
                <h5 class="card-title">Jumlah Tidak Hadir</h5>
                <h3>{{ $jumlahTidakHadir }}</h3>
                <i class="fas fa-times fa-2x float-right"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-custom text-white bg-warning mb-3">
            <div class="card-body">
                <h5 class="card-title">Jumlah Check-Out</h5>
                <h3>{{ $jumlahCheckOut }}</h3>
                <i class="fas fa-sign-out-alt fa-2x float-right"></i>
            </div>
        </div>
    </div>
    @else
    <!-- Karyawan's Dashboard: Kehadiran Bulanan -->
    <div class="col-md-4">
        <div class="card card-custom text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Jumlah Hadir Bulan Ini</h5>
                <h3>{{ $jumlahHadir }}</h3>
                <i class="fas fa-check fa-2x float-right"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-custom text-white bg-danger mb-3">
            <div class="card-body">
                <h5 class="card-title">Jumlah Tidak Hadir Bulan Ini</h5>
                <h3>{{ $jumlahTidakCheckIn }}</h3>
                <i class="fas fa-times fa-2x float-right"></i>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection