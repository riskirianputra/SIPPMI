<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFakultasTable extends Migration
{
    public function up()
    {
        Schema::create('fakultas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('singkatan')->unique();
            $table->string('kode')->nullable();
            $table->timestamps();
        });
    }
}
