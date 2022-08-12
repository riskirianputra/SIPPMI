<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTabelPenelitianReviewers extends Migration
{
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table){
            $table->integer('biaya')->nullable()->before('created_at');
            $table->text('komentar')->nullable()->before('created_at');
            $table->date('review_at')->nullable()->before('created_at');
        });

    }

    public function down()
    {
        Schema::table('reviews', function (Blueprint $table){
            $table->dropColumn('biaya');
            $table->dropColumn('komentar');
            $table->dropColumn('review_at');
        });
    }
}
