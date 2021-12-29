<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddArtikelToTanggungJawabPerusahaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tanggung_jawab_perusahaan', function (Blueprint $table) {
            $table->longText('artikel')->nullable()->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tanggung_jawab_perusahaan', function (Blueprint $table) {
            $table->dropColumn('artikel');
        });
    }
}
