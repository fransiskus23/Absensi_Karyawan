@extends('home')

@section('konten')
<div class="container">
    <h2>Data Absensi</h2>

    {{-- Notifikasi sukses / error --}}
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Tombol Check-In, Check-Out dan Tidak Hadir --}}
    <div class="mb-3">
        {{-- Tombol Check-In --}}
        <form action="{{ route('absensi.checkIn') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-success"
                {{ isset($user->absensi_today) && $user->absensi_today->check_in ? 'disabled' : '' }}
                {{ isset($user->absensi_today) && $user->absensi_today->status_absensi == 'Tidak Hadir' ? 'disabled' : '' }}>
                Check-In
            </button>
        </form>

        {{-- Tombol Check-Out --}}
        <form action="{{ route('absensi.checkOut') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-warning"
                {{ !isset($user->absensi_today) || $user->absensi_today->check_out ? 'disabled' : '' }}>
                Check-Out
            </button>
        </form>

        {{-- Tombol Tidak Hadir --}}
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#tidakHadirModal"
            {{ isset($user->absensi_today) && ($user->absensi_today->check_in || $user->absensi_today->status_absensi == 'Tidak Hadir') ? 'disabled' : '' }}>
            Tidak Hadir
        </button>
    </div>

    {{-- Tabel Absensi --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    @if($user->role === 'admin')
                    <th>Nama</th>
                    @endif
                    <th>Tanggal</th>
                    <th>Check-In</th>
                    <th>Check-Out</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($absensis as $absensi)
                <tr>
                    @if($user->role === 'admin')
                    <td>{{ $absensi->user->name }}</td>
                    @endif
                    <td>{{ \Carbon\Carbon::parse($absensi->tanggal)->format('d-m-Y') }}</td>
                    <td>{{ $absensi->check_in ?? '-' }}</td>
                    <td>{{ $absensi->check_out ?? '-' }}</td>
                    <td>{{ $absensi->status_absensi }}</td>
                    <td>{{ $absensi->keterangan ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="{{ $user->role === 'admin' ? 6 : 5 }}">Belum ada data absensi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tidak Hadir -->
<div class="modal fade" id="tidakHadirModal" tabindex="-1" aria-labelledby="tidakHadirModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('absensi.tidakHadir') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="tidakHadirModalLabel">Keterangan Tidak Hadir</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="keterangan">Pilih Keterangan:</label>
                        <select name="keterangan" id="keterangan" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <option value="Sakit">Sakit</option>
                            <option value="Izin">Izin</option>
                            <option value="Alfa">Alfa (Tanpa Keterangan)</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Submit Tidak Hadir</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection