<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUmkmBinaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('umkm_binaan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->bigInteger('id_kota', false, true);
            $table->string('jenis_usaha');
            $table->text('alamat');
            $table->string('no_telp', 15)->default('-');
            $table->longText('deskripsi');
            $table->longText('foto');
            $table->timestamps();

            $table->foreign('id_kota')->references('id')->on('kota')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('umkm_binaan');
    }
}
