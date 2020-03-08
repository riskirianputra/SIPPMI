<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsulansTable extends Migration
{
    public function up()
    {
        Schema::create('usulans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pengusul_id')->nullable();
            $table->string('status_usulan')->nullable();
            $table->string('jenis_usulan')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('pengusul_id')->references('id')->on('users');
        });
    }
}
