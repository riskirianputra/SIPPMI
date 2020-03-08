<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPengabdiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengabdians', function (Blueprint $table) {
            $table->decimal('biaya_final')->after('biaya')->nullable();
            $table->string('file_cv')->after('biaya_final')->nullable();
            $table->string('file_pengesahan')->after('file_cv')->nullable();
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
