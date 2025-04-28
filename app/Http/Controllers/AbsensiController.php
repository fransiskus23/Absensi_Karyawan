<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $absensiToday = Absensi::where('user_id', $user->id)
            ->where('tanggal', Carbon::today()->toDateString())
            ->first();

        $user->absensi_today = $absensiToday;

        if ($user->role === 'admin') {
            $absensis = Absensi::with('user')->orderBy('tanggal', 'desc')->get();
        } else {
            $absensis = Absensi::where('user_id', $user->id)->orderBy('tanggal', 'desc')->get();
        }

        return view('absensi.index', compact('absensis', 'user'));
    }

    public function checkIn()
    {
        $user = Auth::user();
        $today = Carbon::today()->toDateString();

        $existing = Absensi::where('user_id', $user->id)
            ->where('tanggal', $today)
            ->first();

        if ($existing) {
            if ($existing->status_absensi == 'Tidak Hadir') {
                return redirect()->back()->with('error', 'Anda sudah menandai Tidak Hadir hari ini, tidak bisa Check-In.');
            }
            return redirect()->back()->with('error', 'Anda sudah melakukan Check-In hari ini.');
        }

        $now = Carbon::now();
        $statusWaktu = $now->lessThan(Carbon::today()->addHours(9)) ? 'Tepat Waktu' : 'Terlambat';

        Absensi::create([
            'user_id' => $user->id,
            'tanggal' => $today,
            'check_in' => $now->format('H:i:s'),
            'status_absensi' => 'Hadir',
            'keterangan' => $statusWaktu,
        ]);

        return redirect()->back()->with('success', 'Check-In berhasil.');
    }

    public function checkOut()
    {
        $user = Auth::user();
        $today = Carbon::today()->toDateString();

        $absensi = Absensi::where('user_id', $user->id)
            ->where('tanggal', $today)
            ->first();

        if (!$absensi) {
            return redirect()->back()->with('error', 'Anda belum melakukan Check-In.');
        }

        if ($absensi->status_absensi == 'Tidak Hadir') {
            return redirect()->back()->with('error', 'Anda sudah menandai Tidak Hadir hari ini, tidak bisa Check-Out.');
        }

        if ($absensi->check_out) {
            return redirect()->back()->with('error', 'Anda sudah melakukan Check-Out.');
        }

        $now = Carbon::now();

        if ($now->lessThan(Carbon::today()->addHours(17))) {
            return redirect()->back()->with('error', 'Check-Out hanya bisa dilakukan setelah jam 17:00.');
        }

        $absensi->update([
            'check_out' => $now->format('H:i:s'),
        ]);

        return redirect()->back()->with('success', 'Check-Out berhasil.');
    }

    public function markTidakHadir(Request $request)
    {
        $request->validate([
            'keterangan' => 'required|in:Sakit,Izin,Alfa',
        ]);

        $user = Auth::user();
        $today = Carbon::today()->toDateString();

        $existing = Absensi::where('user_id', $user->id)
            ->where('tanggal', $today)
            ->first();

        if ($existing) {
            if ($existing->check_in) {
                return redirect()->back()->with('error', 'Anda sudah Check-In hari ini, tidak bisa menandai Tidak Hadir.');
            }

            if ($existing->status_absensi == 'Tidak Hadir') {
                return redirect()->back()->with('error', 'Anda sudah menandai Tidak Hadir hari ini.');
            }
        }

        Absensi::updateOrCreate(
            ['user_id' => $user->id, 'tanggal' => $today],
            [
                'status_absensi' => 'Tidak Hadir',
                'keterangan' => $request->keterangan,
            ]
        );

        return back()->with('success', 'Status ketidakhadiran berhasil ditandai.');
    }

    public function edit(Absensi $absensi)
    {
        return view('absensi.edit', compact('absensi'));
    }

    public function update(Request $request, Absensi $absensi)
    {
        $request->validate([
            'check_in' => 'nullable|date_format:H:i:s',
            'check_out' => 'nullable|date_format:H:i:s',
            'status_absensi' => 'nullable|in:Hadir,Tidak Hadir',
            'keterangan' => 'nullable|in:Sakit,Izin,Alfa,Tepat Waktu,Terlambat',
        ]);

        $absensi->update($request->only(['check_in', 'check_out', 'status_absensi', 'keterangan']));

        return redirect()->route('absensi.index')->with('success', 'Absensi berhasil diupdate');
    }

    public function destroy(Absensi $absensi)
    {
        $absensi->delete();
        return redirect()->route('absensi.index')->with('success', 'Absensi berhasil dihapus');
    }
}
