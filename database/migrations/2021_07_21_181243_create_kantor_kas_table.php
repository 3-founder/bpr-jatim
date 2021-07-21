<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKantorKasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kantor_kas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_kota')->nullable()->unsigned();
            $table->string('jaringan_kantor');
            $table->enum('jenis', ['KK', 'ATM', 'MK', 'PP']);
            $table->string('alamat');
            $table->string('kode_area', 10)->nullable();
            $table->string('telepon', 13)->nullable();
            $table->string('fax',10)->nullable();
            $table->timestamps();

            $table->foreign('id_kota')->references('id')->on('kota');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kantor_kas');
    }
}
