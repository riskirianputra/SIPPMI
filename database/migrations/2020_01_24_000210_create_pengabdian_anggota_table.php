<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengabdianAnggotaTable extends Migration
{
    public function up()
    {
        Schema::create('pengabdian_anggota', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pengabdian_id')->nullable();
            $table->unsignedInteger('dosen_id')->nullable();
            $table->string('jabatan')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('pengabdian_id')->references('id')->on('pengabdians');
            $table->foreign('dosen_id')->references('id')->on('dosens');
        });
    }
}
