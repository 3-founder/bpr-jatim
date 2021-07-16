<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profil', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->text('kantor_pusat');
            $table->string('facebook');
            $table->string('instagram');
            $table->string('youtube');
            $table->string('email', 50);
            $table->string('telepon1', 50)->nullable();
            $table->string('telepon2', 50)->nullable();
            $table->string('telepon3', 50)->nullable();
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
        Schema::dropIfExists('profil');
    }
}
