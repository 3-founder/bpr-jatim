<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipsKeamananInfoTerkini extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tips_keamanan_info_terkini', function (Blueprint $table) {
            $table->id();
            $table->string('judul_tips_keamanan');
            $table->binary('konten_tips_keamanan');
            $table->string('judul_info_terkini');
            $table->binary('konten_info_terkini');
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
        Schema::dropIfExists('tips_keamanan_info_terkini');
    }
}
