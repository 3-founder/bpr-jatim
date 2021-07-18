<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTipeOnAboutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('about', function (Blueprint $table) {
        //     $table->enum('tipe', ['sejarah', 'visi-misi', 'peranan', 'stuktur', 'manajemen', 'identitas', 'hukum', 'komposisi', 'tata_kelola'])->change();
        // });
        \DB::unprepared("ALTER TABLE about MODIFY COLUMN tipe ENUM('sejarah', 'visi-misi', 'peranan', 'stuktur', 'manajemen', 'identitas', 'hukum', 'komposisi', 'tata_kelola')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('about', function (Blueprint $table) {
            $table->enum('tipe', ['sejarah', 'visi-misi', 'peranan', 'stuktur', 'manajemen', 'identitas'])->change();
        });
    }
}
