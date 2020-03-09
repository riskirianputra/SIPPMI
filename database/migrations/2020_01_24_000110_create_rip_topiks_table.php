<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRipTopiksTable extends Migration
{
    public function up()
    {
        Schema::create('rip_topiks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('subtema_id')->nullable();
            $table->string('nama')->nullable();
            $table->longText('luaran')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('subtema_id')->references('id')->on('rip_sub_temas');
        });
    }
}
