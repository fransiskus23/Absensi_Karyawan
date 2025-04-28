<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensisTable extends Migration
{
    public function up()
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id(); // auto increment ID
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key ke tabel users
            $table->date('tanggal');
            $table->enum('status_absensi', ['hadir', 'sakit', 'izin', 'alpha']);
            $table->timestamps(); // Menyimpan created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('absensis');
    }
}