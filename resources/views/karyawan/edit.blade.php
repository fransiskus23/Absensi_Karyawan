@extends('home')

@section('konten')
<h1>Edit Karyawan</h1>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input type="text" class="form-control" name="name" value="{{ old('name', $karyawan->name) }}" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" value="{{ old('email', $karyawan->email) }}" required>
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">Telepon</label>
        <input type="text" class="form-control" name="phone" value="{{ old('phone', $karyawan->phone) }}" required>
    </div>

    <div class="mb-3">
        <label for="jabatan_id" class="form-label">Jabatan</label>
        <select name="jabatan_id" class="form-control" required>
            <option value="">-- Pilih Jabatan --</option>
            @foreach ($jabatans as $jabatan)
            <option value="{{ $jabatan->id }}" {{ $karyawan->jabatan_id == $jabatan->id ? 'selected' : '' }}>
                {{ $jabatan->nama_jabatan }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="role" class="form-label">Role</label>
        <select name="role" class="form-control" required>
            <option value="admin" {{ $karyawan->role == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="karyawan" {{ $karyawan->role == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('karyawan.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection