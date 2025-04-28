@extends('home')

@section('konten')
<h1>Tambah Karyawan</h1>

<form action="{{ route('karyawan.store') }}" method="POST">
    @csrf

    <div>
        <label for="name">Nama</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
    </div>

    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required>
    </div>

    <div>
        <label for="phone">Phone</label>
        <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required>
    </div>

    <div>
        <label for="jabatan_id">Jabatan</label>
        <select name="jabatan_id" id="jabatan_id" required>
            <option value="">Pilih Jabatan</option>
            @foreach($jabatans as $jabatan)
            <option value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="role">Role</label>
        <select name="role" id="role" required>
            <option value="admin">Admin</option>
            <option value="karyawan">Karyawan</option>
        </select>
    </div>

    <button type="submit">Simpan</button>
</form>
@endsection