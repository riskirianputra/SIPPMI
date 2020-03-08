<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyColumnsToPengabdiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengabdians', function (Blueprint $table) {
//            $table->dropPrimary('pengabdians_id_primary');
//            $table->dropColumn('id');

//            $table->unsignedInteger('id');
//            $table->foreign('id')->references('id')->on('usulans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengabdians', function (Blueprint $table) {
            //
        });
    }
}
