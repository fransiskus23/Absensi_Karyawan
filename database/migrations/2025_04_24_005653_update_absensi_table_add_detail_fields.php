<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('absensis', function (Blueprint $table) {
            $table->time('check_in')->nullable();
            $table->time('check_out')->nullable();
            $table->string('keterangan')->nullable(); // tambahan detail
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
