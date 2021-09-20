<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTanggungJawabPerusahaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanggung_jawab_perusahaan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tahun', false, true);
            $table->binary('file');
            $table->tinyInteger('user_id',false, true);
            $table->timestamps();

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tanggung_jawab_perusahaan');
    }
}
