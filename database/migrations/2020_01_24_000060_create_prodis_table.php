<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdisTable extends Migration
{
    public function up()
    {
        Schema::create('prodis', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('fakultas_id')->nullable();
            $table->string('nama');
            $table->string('kode')->nullable();
            $table->string('kode_dikti')->nullable();
            $table->string('akreditasi')->nullable();
            $table->timestamps();

            $table->foreign('fakultas_id')->references('id')->on('fakultas');
        });
    }
}
