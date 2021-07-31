<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKeteranganToJenisProdukLayananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jenis_produk_layanan', function (Blueprint $table) {
            $table->longText('keterangan')->nullable()->after('nama_jenis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jenis_produk_layanan', function (Blueprint $table) {
            $table->dropColumn('keterangan');
        });
    }
}
