<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenelitianBiayasTable extends Migration
{
    public function up()
    {
        Schema::create('penelitian_biayas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('penelitian_id')->nullable();
            $table->unsignedInteger('biaya_skema_id')->nullable();
            $table->float('jumlah', 15, 2);
            $table->float('jumlah_final', 15, 2)->nullable();
            $table->string('satuan');
            $table->integer('harga_satuan');
            $table->integer('harga_satuan_final')->nullable();
            $table->longText('justifikasi')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('biaya_skema_id', 'biaya_skema_fk_837441')->references('id')->on('biaya_skemas');
            $table->foreign('penelitian_id', 'penelitian_fk_837442')->references('id')->on('penelitians');
        });
    }
}
