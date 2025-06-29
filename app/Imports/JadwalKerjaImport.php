<?php

namespace App\Imports;

use App\Models\JadwalKerja;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class JadwalKerjaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new JadwalKerja([
            'karyawan' => $row['karyawan'],
            'tanggal' => is_numeric($row['tanggal'])
                ? Date::excelToDateTimeObject($row['tanggal'])->format('Y-m-d')
                : Carbon::parse($row['tanggal'])->format('Y-m-d'),
            'shift' => $row['shift'],
        ]);
    }
}
