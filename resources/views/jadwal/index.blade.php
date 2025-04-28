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

    <form action="{{ route('jadwal.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="file" class="form-label">Upload Jadwal Kerja (Excel):</label>
            <input type="file" name="file" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>

    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>User</th>
                <th>Tanggal</th>
                <th>Shift</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jadwalKerja as $jadwal)
            <tr>
                <td>{{ $jadwal->user->name }}</td>
                <td>{{ $jadwal->tanggal }}</td>
                <td>{{ $jadwal->shift }}</td>
                <td>
                    <a href="{{ route('jadwal.update', $jadwal->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('jadwal.delete', $jadwal->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('jadwal.download') }}" class="btn btn-success">Download Jadwal Kerja</a>
</div>
@endsection