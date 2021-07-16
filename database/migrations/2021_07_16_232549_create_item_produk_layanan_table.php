<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemProdukLayananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_produk_layanan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_jenis', false, true);
            $table->string('judul');
            $table->string('slug');
            $table->string('text_top');
            $table->text('konten');
            $table->timestamps();

            $table->foreign('id_jenis')->references('id')->on('jenis_produk_layanan')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_produk_layanan');
    }
}
