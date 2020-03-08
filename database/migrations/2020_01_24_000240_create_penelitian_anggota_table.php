<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenelitianAnggotaTable extends Migration
{
    public function up()
    {
        Schema::create('usulan_anggota', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipe')->default(1); //1 Dosen, 2 Mahasiswa
            $table->unsignedInteger('dosen_id')->nullable();
            $table->unsignedInteger('usulan_id')->nullable();
            $table->string('nama')->nullable();
            $table->string('identifier')->nullable();
            $table->string('unit')->nullable();
            $table->string('jabatan')->nullable();
            $table->timestamps();

            $table->foreign('dosen_id')->references('id')->on('dosens');
            $table->foreign('usulan_id')->references('id')->on('usulans');
        });
    }
}
