<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    // Tentukan kolom yang bisa diisi (mass assignable)
    protected $fillable = [
        'user_id',
        'tanggal',
        'check_in',
        'check_out',
        'status_absensi',
        'keterangan',
    ];

    // Definisikan relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
