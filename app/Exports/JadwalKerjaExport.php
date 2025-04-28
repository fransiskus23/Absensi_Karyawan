<?php

namespace App\Exports;

use App\Models\JadwalKerja;
use Maatwebsite\Excel\Concerns\FromCollection;

class JadwalKerjaExport implements FromCollection
{
    public function collection()
    {
        return JadwalKerja::all();
    }
}
