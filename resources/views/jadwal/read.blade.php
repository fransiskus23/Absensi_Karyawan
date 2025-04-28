@extends('home')

@section('konten')
<div class="container">
    <h2>Jadwal Kerja</h2>

    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>Tanggal</th>
                <th>Shift</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jadwalKerja as $jadwal)
            <tr>
                <td>{{ $jadwal->tanggal }}</td>
                <td>{{ $jadwal->shift }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('jadwal.download') }}" class="btn btn-success">Download Jadwal Kerja</a>
</div>
@endsection