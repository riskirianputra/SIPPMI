<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewersTable extends Migration
{
    public function up()
    {
        Schema::create('reviewers', function (Blueprint $table) {
            $table->increments('id');

            $table->string('status');

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
