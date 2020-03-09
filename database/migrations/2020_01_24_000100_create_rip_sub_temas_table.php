<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRipSubTemasTable extends Migration
{
    public function up()
    {
        Schema::create('rip_sub_temas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tema_id')->nullable();
            $table->string('nama')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('tema_id')->references('id')->on('rip_temas');
        });
    }
}
