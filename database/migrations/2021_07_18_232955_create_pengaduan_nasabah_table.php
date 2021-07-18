<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengaduanNasabahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaduan_nasabah', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_kota', false, true);
            $table->string('nama');
            $table->longText('tempat_lahir');
            $table->date('tgl_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('jenis_identitas');
            $table->string('nomor_identitas');
            $table->longText('alamat');
            $table->string('no_telp', 20);
            $table->string('no_hp', 20);
            $table->string('no_fax');
            $table->string('no_rekening');
            $table->string('nama_perwakilan');
            $table->longText('tempat_lahir_perwakilan');
            $table->date('tgl_lahir_perwakilan');
            $table->enum('jenis_kelamin_perwakilan', ['Laki-laki', 'Perempuan']);
            $table->string('jenis_identitas_perwakilan');
            $table->string('nomor_identitas_perwakilan');
            $table->longText('alamat_perwakilan');
            $table->string('no_telp_perwakilan', 20);
            $table->string('no_hp_perwakilan', 20);
            $table->string('no_fax_perwakilan');
            $table->enum('jenis_rekening', ['Tabungan', 'Deposito', 'ATM', 'Kredit', 'Lainnya']);
            $table->longText('detail_pengaduan')->nullable();
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
        Schema::dropIfExists('pengaduan_nasabah');
    }
}
