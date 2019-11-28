<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('besar_angsuran');
            $table->integer('administrasi_angsuran');
            $table->double('jasa_angsuran', 15, 1);
            $table->double('provisi_angsuran', 15, 1);
            $table->double('pemupukan_angsuran', 15, 1);
            $table->integer('besar_kilat');
            $table->double('jasa_kilat', 15, 1);
            $table->double('provisi_kilat', 15, 1);
            $table->double('pemupukan_kilat', 15, 1);
            $table->double('jasa_pengurus', 15, 1);
            $table->double('jasa_pengawas', 15, 1);
            $table->double('shu_sosial', 15, 1);
            $table->double('shu_cadangan', 15, 1);
            $table->double('jasa_simpanan', 15, 1);
            $table->double('jasa_pinjaman', 15, 1);
            $table->integer('administrasi_kilat');
            $table->integer('rit_simpanan_manasuka');
            $table->integer('rit_simpanan_wajib');
            $table->boolean('cek_pinjaman')->default(1);
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
        Schema::dropIfExists('settings');
    }
}

        