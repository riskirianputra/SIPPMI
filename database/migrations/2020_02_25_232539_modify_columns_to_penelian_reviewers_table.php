<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyColumnsToPenelianReviewersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penelitian_reviewers', function (Blueprint $table) {
            $table->dropForeign(['penelitian_id']);
            $table->renameColumn('penelitian_id', 'usulan_id');

            $table->foreign('usulan_id')->references('id')->on('usulans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penelitian_reviewers', function (Blueprint $table) {
            //
        });
    }
}
