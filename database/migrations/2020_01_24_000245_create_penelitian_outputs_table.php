<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenelitianOutputsTable extends Migration
{
    public function up()
    {
        Schema::create('penelitian_outputs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('penelitian_id');
            $table->unsignedInteger('output_skema_id');
            $table->string('filename');
            $table->date('tanggal_upload');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('output_skema_id')->references('id')->on('output_skemas');
            $table->foreign('penelitian_id')->references('id')->on('penelitians');
        });
    }
}
