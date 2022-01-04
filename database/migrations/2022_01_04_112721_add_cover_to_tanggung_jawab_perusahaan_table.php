<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCoverToTanggungJawabPerusahaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tanggung_jawab_perusahaan', function (Blueprint $table) {
            $table->string('cover')->nullable()->after('file');
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
            $table->dropColumn('cover');
        });
    }
}
