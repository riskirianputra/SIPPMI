<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenSkemasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosen_skemas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('dosen_id');
            $table->unsignedInteger('ref_skema_id');
            $table->timestamps();

            $table->foreign('dosen_id')->references('id')->on('dosens');
            $table->foreign('ref_skema_id')->references('id')->on('ref_skemas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dosen_skemas');
    }
}
