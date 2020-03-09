<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisUsulansTable extends Migration
{
    public function up()
    {
        Schema::create('jenis_usulans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode')->nullable();
            $table->string('nama')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
