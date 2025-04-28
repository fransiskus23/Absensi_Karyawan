<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jabatan;

class JabatanSeeder extends Seeder
{
    public function run()
    {
        Jabatan::create(['nama_jabatan' => 'Manager']);
        Jabatan::create(['nama_jabatan' => 'Supervisor']);
        Jabatan::create(['nama_jabatan' => 'Staff']);
    }
}
