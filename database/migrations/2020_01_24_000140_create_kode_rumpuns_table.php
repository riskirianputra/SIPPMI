<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKodeRumpunsTable extends Migration
{
    public function up()
    {
        Schema::create('kode_rumpuns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode')->nullable();
            $table->string('rumpun_ilmu')->nullable();
            $table->integer('level')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
