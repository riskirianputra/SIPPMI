<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutputSkemasTable extends Migration
{
    public function up()
    {
        Schema::create('output_skemas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('output_id');
            $table->unsignedInteger('skema_id');
            $table->string('field');
            $table->string('mime')->nullable();
            $table->boolean('required')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('output_id')->references('id')->on('outputs');
            $table->foreign('skema_id')->references('id')->on('ref_skemas');
        });
    }
}
