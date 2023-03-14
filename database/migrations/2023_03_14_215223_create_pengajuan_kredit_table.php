<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanKreditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_kredit', function (Blueprint $table) {
            $table->id();
            $table->integer('nominal')->nullable();
            $table->string('tenor', 1)->nullable();
            $table->string('nama')->nullable();
            $table->string('telp', 15)->nullable();
            $table->string('email')->nullable();
            $table->longText('alamat')->nullable();
            $table->string('kota')->nullable();
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
        Schema::dropIfExists('pengajuan_kredit');
    }
}
