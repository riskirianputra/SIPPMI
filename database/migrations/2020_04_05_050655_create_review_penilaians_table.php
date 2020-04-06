<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewPenilaiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_penilaians', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('review_id');
            $table->unsignedBigInteger('ref_skema_question_id');
            $table->text('pertanyaan')->nullable();
            $table->double('bobot')->nullable();
            $table->double('nilai')->nullable();
            $table->timestamps();

            $table->foreign('review_id')->references('id')->on('reviews');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review_penilaians');
    }
}
