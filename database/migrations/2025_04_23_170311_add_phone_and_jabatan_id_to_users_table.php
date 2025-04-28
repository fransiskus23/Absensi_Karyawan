<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhoneAndJabatanIdToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable();
            }

            if (!Schema::hasColumn('users', 'jabatan_id')) {
                $table->unsignedBigInteger('jabatan_id')->nullable();
                $table->foreign('jabatan_id')->references('id')->on('jabatans');
            }
        });
    }


    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropForeign(['jabatan_id']);
            $table->dropColumn('jabatan_id');
        });
    }
}
