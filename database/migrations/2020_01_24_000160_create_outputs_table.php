<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutputsTable extends Migration
{
    public function up()
    {
        Schema::create('outputs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('jenis_usulan');
            $table->string('code');
            $table->string('luaran');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
