<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Absensi;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $jumlahKaryawan = User::count(); // Total user
        $absensiData = Absensi::selectRaw('DATE(tanggal) as tanggal, COUNT(*) as total')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->take(7) // Mengambil 7 hari terakhir
            ->get();

        return view('home', [
            'jumlahKaryawan' => $jumlahKaryawan,
            'absensiData' => $absensiData,
        ]);
    }
}