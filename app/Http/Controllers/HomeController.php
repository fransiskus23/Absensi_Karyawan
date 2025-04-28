<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Absensi;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil data jumlah karyawan
        $jumlahKaryawan = User::count();

        // Jika admin
        if (auth()->user()->role == 'admin') {
            // Ambil data absensi terbaru
            $jumlahCheckIn = Absensi::where('status_absensi', 'Hadir')->count();
            $jumlahTidakHadir = Absensi::where('status_absensi', 'Tidak Hadir')->count();
            $jumlahCheckOut = Absensi::where('status_absensi', 'Check-out')->count();

            return view('dashboard', compact('jumlahKaryawan', 'jumlahCheckIn', 'jumlahTidakHadir', 'jumlahCheckOut'));
        } else {
            // Ambil data absensi bulanan untuk karyawan
            $bulanSekarang = Carbon::now()->format('m');
            $jumlahTidakCheckIn = Absensi::where('user_id', auth()->user()->id)
                ->whereMonth('tanggal', $bulanSekarang)
                ->where('status_absensi', 'Tidak Hadir')
                ->count();

            $jumlahHadir = Absensi::where('user_id', auth()->user()->id)
                ->whereMonth('tanggal', $bulanSekarang)
                ->where('status_absensi', 'Hadir')
                ->count();

            return view('dashboard', compact('jumlahKaryawan', 'jumlahTidakCheckIn', 'jumlahHadir'));
        }
    }
}
