<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class EditKotaToPengajuanKreditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengajuan_kredit', function (Blueprint $table) {
            DB::statement('ALTER TABLE `pengajuan_kredit` CHANGE `kota` `kota` bigint(20) unsigned NULL ');
            DB::statement('ALTER TABLE `pengajuan_kredit` ADD FOREIGN KEY (`kota`) references kota(id) ON UPDATE CASCADE ON DELETE CASCADE');
            $table->enum('status', [1, 0])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengajuan_kredit', function (Blueprint $table) {
            //
        });
    }
}
