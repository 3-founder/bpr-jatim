<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdKategoriToBeritaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->dropColumn('kategori');
            $table->integer('id_kategori')->unsigned()->nullable()->after('id_user');

            $table->foreign('id_kategori')->references('id')->on('kategori_berita');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->string('kategori');
            $table->dropForeign('berita_id_kategori_foreign');
            $table->dropColumn('id_kategori');
        });
    }
}
