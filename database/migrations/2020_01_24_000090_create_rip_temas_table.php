<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRipTemasTable extends Migration
{
    public function up()
    {
        Schema::create('rip_temas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('periode')->nullable();
            $table->integer('status')->nullable();
            $table->string('nama')->nullable();
            $table->longText('luaran')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
