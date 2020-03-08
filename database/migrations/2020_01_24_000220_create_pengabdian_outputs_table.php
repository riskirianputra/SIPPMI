<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengabdianOutputsTable extends Migration
{
    public function up()
    {
        Schema::create('pengabdian_outputs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('output_skema_id');
            $table->unsignedInteger('pengabdian_id');
            $table->string('filename');
            $table->date('tanggal_upload');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('output_skema_id')->references('id')->on('output_skemas');
            $table->foreign('pengabdian_id')->references('id')->on('pengabdians');
        });
    }
}
