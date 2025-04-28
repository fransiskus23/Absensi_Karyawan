<?php

namespace App\Imports;

use App\Models\JadwalKerja;
use Maatwebsite\Excel\Concerns\ToModel;

class JadwalKerjaImport implements ToModel
{
public function model(array $row)
{
return new JadwalKerja([
'user_id' => $row[0], 
'tanggal' => $row[1],
'shift' => $row[2],
]);
}
}