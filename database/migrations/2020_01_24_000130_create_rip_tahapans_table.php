<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRipTahapansTable extends Migration
{
    public function up()
    {
        Schema::create('rip_tahapans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sub_topik_id')->nullable();
            $table->integer('tahun')->nullable();
            $table->longText('bahasan')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('sub_topik_id')->references('id')->on('rip_sub_topiks');
        });
    }
}
