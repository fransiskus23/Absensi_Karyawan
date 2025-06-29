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
        $request->validate([
            'karyawan' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'shift' => 'required|string|max:50',
        ]);

        $jadwal = JadwalKerja::find($id);
        if ($jadwal) {
            $jadwal->update([
                'karyawan' => $request->karyawan,
                'tanggal' => $request->tanggal,
                'shift' => $request->shift,
            ]);
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
        $userId = auth()->user()->id;
        $jadwalKerja = JadwalKerja::where('user_id', $userId)->get();
        return view('jadwal.read', compact('jadwalKerja'));
    }

    public function import(request $request)
    {
        $file = $request->file('file');
        $name_file = $file->getClientOriginalName();
        $file->move('Jadwal Kerja', $name_file);

        Excel::import(new JadwalKerjaImport, public_path('/Jadwal Kerja/' . $name_file));
        return redirect()->route('jadwal.index')->with('success', 'Jadwal kerja berhasil diimport.');
    }

    public function deleteAll()
    {
        JadwalKerja::truncate();
        return redirect()->route('jadwal.index')->with('success', 'Semua jadwal kerja berhasil dihapus.');
    }


}
