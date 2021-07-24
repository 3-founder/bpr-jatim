<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKetToKursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kurs', function (Blueprint $table) {
            $table->enum('ket_beli', ['naik', 'turun', 'tetap'])->default('tetap')->after('temp_harga_beli');
            $table->enum('ket_jual', ['naik', 'turun', 'tetap'])->default('tetap')->after('temp_harga_jual');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kurs', function (Blueprint $table) {
            $table->dropColumn('ket_beli');
            $table->dropColumn('ket_jual');
        });
    }
}
