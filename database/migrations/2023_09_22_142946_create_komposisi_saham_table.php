<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKomposisiSahamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komposisi_saham', function (Blueprint $table) {
            $table->id();
            $table->string('pemilik_saham', 50);
            $table->enum('jenis', ['pemprov','kota/kab','dpd']);
            $table->bigInteger('lembar', false, true);
            $table->bigInteger('nominal', false, true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('komposisi_saham');
    }
}
