<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenelitianReviewersTable extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tahapan_review_id');
            $table->unsignedInteger('reviewer_id');
            $table->unsignedInteger('penelitian_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('tahapan_review_id')->references('id')->on('tahapan_reviews');
            $table->foreign('reviewer_id')->references('id')->on('reviewers');
            $table->foreign('penelitian_id')->references('id')->on('penelitians');
        });
    }
}
