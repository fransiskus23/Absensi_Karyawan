<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Absensi;
use App\Models\User;
use Carbon\Carbon;

class AbsensiSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            Absensi::create([
                'user_id' => $user->id,
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'check_in' => '08:00:00',
                'check_out' => '16:00:00',
                'status_absensi' => 'Hadir',
                'keterangan' => 'Tepat waktu',
            ]);
        }
    }
}
