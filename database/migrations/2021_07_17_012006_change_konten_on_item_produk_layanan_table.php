<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeKontenOnItemProdukLayananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_produk_layanan', function (Blueprint $table) {
            $table->binary('konten')->after('text_top')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_produk_layanan', function (Blueprint $table) {
            $table->text('konten')->after('text_top')->change();
        });
    }
}
