<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeritaInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berita_info', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug');
            $table->longText('cover')->nullable();
            $table->binary('konten');
            $table->enum('tipe', [
                'berita',
                'promo',
                'epaper',
                'penghargaan',
                'peta-cabang',
                'karier',
                'tips-keamanan',
                'jaringan-kantor',
                'pengumuman-lelang-jaminan',
                'info-terkini'
            ]);
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
        Schema::dropIfExists('berita_info');
    }
}
