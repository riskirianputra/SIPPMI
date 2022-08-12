<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefSkemaQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_skema_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('ref_skema_id');
            $table->text('pertanyaan');
            $table->double('bobot');
            $table->integer('tipe_pertanyaan');
            $table->timestamps();

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
        Schema::dropIfExists('ref_skema_questions');
    }
}
