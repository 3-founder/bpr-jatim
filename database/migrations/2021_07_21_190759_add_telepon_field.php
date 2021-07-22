<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTeleponField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kota', function ($table) {
            $table->string('telp')->nullable()->change();
        });

        Schema::table('kantor_kas', function ($table) {
            $table->string('telepon')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kota', function ($table) {
            $table->string('telp', 20)->nullable()->change();
        });

        Schema::table('kantor_kas', function ($table) {
            $table->string('telepon', 13)->nullable()->change();
        });
    }
}
