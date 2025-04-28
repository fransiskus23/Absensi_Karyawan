<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function create()
    {
        // Ambil semua jabatan untuk dropdown
        $jabatans = Jabatan::all();
        return view('karyawan.create', compact('jabatans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15',
            'jabatan_id' => 'required|exists:jabatans,id',
            'role' => 'required|in:admin,karyawan',
        ]);

        // Membuat user baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'jabatan_id' => $request->jabatan_id,
            'role' => $request->role,
            'password' => bcrypt('12345'),
        ]);

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan');
    }

    public function index()
    {
        $karyawans = User::with('jabatan')->get();
        return view('karyawan.index', compact('karyawans'));
    }

    public function edit($id)
    {
        $karyawan = User::findOrFail($id);
        $jabatans = Jabatan::all();
        return view('karyawan.edit', compact('karyawan', 'jabatans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|string|max:15',
            'jabatan_id' => 'required|exists:jabatans,id',
            'role' => 'required|in:admin,karyawan',
        ]);

        $karyawan = User::findOrFail($id);
        $karyawan->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'jabatan_id' => $request->jabatan_id,
            'role' => $request->role,
        ]);

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $karyawan = User::findOrFail($id);
        $karyawan->delete();

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus');
    }
}
