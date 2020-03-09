<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKomponenBiayasTable extends Migration
{
    public function up()
    {
        Schema::create('komponen_biayas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->longText('keterangan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
