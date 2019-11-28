<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_anggota')->unique();
            $table->string('no_identitas')->unique();
            $table->string('no_perahu')->unique();
            $table->string('nama_depan');
            $table->string('nama_belakang');
            $table->string('jk');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('alamat');
            $table->string('kota');
            $table->string('provinsi');
            $table->string('hp');
            $table->string('email');
            $table->string('kode_pos');
            $table->text('biodata');
            $table->string('role')->default('anggota');
            $table->string('password');
            $table->string('keterangan_anggota');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        //then set autoincrement to 248
        DB::update("ALTER TABLE users AUTO_INCREMENT = 248;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
