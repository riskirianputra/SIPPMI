<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiayaSkemasTable extends Migration
{
    public function up()
    {
        Schema::create('biaya_skemas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('biaya_id')->nullable();
            $table->float('persen_max', 15, 2)->nullable();
            $table->float('persen_min', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('biaya_id')->references('id')->on('komponen_biayas');
        });
    }
}
