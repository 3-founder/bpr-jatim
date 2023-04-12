<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTataKelolaPerusahaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tata_kelola_perusahaan', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun', false, true)->unique();
            $table->string('title')->nullable();
            $table->string('cover')->nullable();
            $table->binary('file');
            $table->tinyInteger('user_id', false, true);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tata_kelola_perusahaan');
    }
}
