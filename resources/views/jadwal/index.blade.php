@extends('home')

@section('konten')
    <div class="container">
        <h2>Jadwal Kerja</h2>

        {{-- Notifikasi sukses / error --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- Form Upload dan Hapus Semua --}}
        <div class="row mb-3">
            @can('admin')
            <div class="col-md-8">
                <form action="{{ route('import.jadwal') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group">
                        <input type="file" name="file" class="form-control" required>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
            <div class="col-md-4 text-end">
                <form action="{{ route('jadwal.deleteAll') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus semua data jadwal kerja?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus Semua</button>
                </form>
            </div>
            @endcan
        </div>

        {{-- Tabel Jadwal --}}
        <table class="table table-bordered">
            <thead class="table-dark">
            <tr>
                <th>Karyawan</th>
                <th>Tanggal</th>
                <th>Shift</th>
                @can('admin')
                <th>Aksi</th>
                @endcan
            </tr>
            </thead>
            <tbody>
            @foreach($jadwalKerja as $jadwal)
                <tr>
                    <td>{{ $jadwal->karyawan }}</td>
                    <td>{{ $jadwal->tanggal }}</td>
                    <td>{{ $jadwal->shift }}</td>
                    @can('admin')
                    <td>
                        {{-- Tombol Edit --}}
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal{{ $jadwal->id }}">
                            Edit
                        </button>

                        {{-- Tombol Hapus --}}
                        <form action="{{ route('jadwal.delete', $jadwal->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus jadwal ini?')">Hapus</button>
                        </form>
                    </td>
                    @endcan
                </tr>
            @endforeach
            </tbody>
        </table>

{{--        <a href="{{ route('jadwal.download') }}" class="btn btn-success mt-2">Download Jadwal Kerja</a>--}}
    </div>

    @foreach($jadwalKerja as $jadwal)
        <!-- Modal Edit -->
        <div class="modal fade" id="editModal{{ $jadwal->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $jadwal->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel{{ $jadwal->id }}">Edit Jadwal</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Karyawan</label>
                                <input type="text" name="karyawan" class="form-control" value="{{ $jadwal->karyawan }}" required>
                            </div>
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" value="{{ $jadwal->tanggal }}" required>
                            </div>
                            <div class="form-group">
                                <label>Shift</label>
                                <input type="text" name="shift" class="form-control" value="{{ $jadwal->shift }}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@endsection
