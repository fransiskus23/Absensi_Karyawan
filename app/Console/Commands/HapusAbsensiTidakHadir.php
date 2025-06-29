<?php

namespace App\Console\Commands;

use App\Models\Absensi;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class HapusAbsensiTidakHadir extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:hapus-absensi-tidak-hadir';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Absensi::whereDate('tanggal', Carbon::today())
            ->whereIn('status_absensi', ['sakit', 'izin', 'alpha'])
            ->whereNull('check_in')
            ->delete();

        $this->info('Data absensi tidak hadir dihapus setelah jam 12 siang.');
    }
}
