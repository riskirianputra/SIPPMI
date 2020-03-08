<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTahapanReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('tahapan_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->integer('jumlah_reviewer');
            $table->date('mulai')->nullable();
            $table->date('selesai')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
