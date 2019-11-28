<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAngsuransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('angsurans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->date('tanggal');
            $table->double('pinjam', 15, 2);
            $table->tinyInteger('cicilan');
            $table->double('provisi', 15, 2);
            $table->double('administrasi', 15, 2);
            $table->double('pemupukan', 15, 2);
            $table->double('jasa', 15, 2);
            $table->boolean('flag_lunas');
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('angsuran_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('angsuran_id');
            $table->date('tanggal');
            $table->double('bayar', 15, 2);
            $table->double('jasa', 15, 2);
            $table->double('subtotal', 15, 2);
            $table->timestamps();
            
            $table->foreign('angsuran_id')->references('id')->on('angsurans')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('angsurans');
        Schema::dropIfExists('angsuran_details');
    }
}

        