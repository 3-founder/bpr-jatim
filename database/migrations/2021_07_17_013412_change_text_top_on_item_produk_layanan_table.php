<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTextTopOnItemProdukLayananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_produk_layanan', function (Blueprint $table) {
            $table->longText('text_top')->after('slug')->change();
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
            $table->text('text_top')->after('slug')->change();
        });
    }
}
