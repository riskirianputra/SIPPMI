<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRipSubTopiksTable extends Migration
{
    public function up()
    {
        Schema::create('rip_sub_topiks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('topik_id')->nullable();
            $table->string('nama')->nullable();
            $table->string('luaran')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('topik_id')->references('id')->on('rip_topiks');
        });
    }
}
