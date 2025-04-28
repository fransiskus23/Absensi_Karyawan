<?php

namespace App\Http\Controllers;

use App\Models\JadwalKerja;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\JadwalKerjaImport;
use App\Exports\JadwalKerjaExport;

class JadwalKerjaController extends Controller
{
    public function index()
    {
        $jadwalKerja = JadwalKerja::all();
        return view('jadwal.index', compact('jadwalKerja'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        try {
            Excel::import(new JadwalKerjaImport, $request->file('file'));
            return redirect()->route('jadwal.index')->with('success', 'Jadwal kerja berhasil di-upload.');
        } catch (\Exception $e) {
            return redirect()->route('jadwal.index')->with('error', 'Gagal meng-upload jadwal kerja.');
        }
    }

    public function update(Request $request, $id)
    {
        $jadwal = JadwalKerja::find($id);
        if ($jadwal) {
            $jadwal->update($request->all());
            return redirect()->route('jadwal.index')->with('success', 'Jadwal kerja berhasil diperbarui.');
        }
        return redirect()->route('jadwal.index')->with('error', 'Jadwal kerja tidak ditemukan.');
    }

    public function delete($id)
    {
        $jadwal = JadwalKerja::find($id);
        if ($jadwal) {
            $jadwal->delete();
            return redirect()->route('jadwal.index')->with('success', 'Jadwal kerja berhasil dihapus.');
        }
        return redirect()->route('jadwal.index')->with('error', 'Jadwal kerja tidak ditemukan.');
    }

    public function download()
    {
        return Excel::download(new JadwalKerjaExport, 'jadwal_kerja.xlsx');
    }

    public function read()
    {
        $jadwalKerja = JadwalKerja::all();
        return view('jadwal.read', compact('jadwalKerja'));
    }
}
