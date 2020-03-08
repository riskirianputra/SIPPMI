<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosensTable extends Migration
{
    public function up()
    {
        Schema::create('dosens', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->string('nama');
            $table->unsignedInteger('prodi_id')->nullable();
            $table->string('nip')->nullable();
            $table->string('nidn')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('jabatan_fungsional')->nullable();
            $table->string('status')->nullable();
            $table->string('email')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('pangkat_golongan')->nullable();
            $table->string('telepon')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->primary('id');
            //$table->foreign('prodi_id')->references('id')->on('prodis');
            $table->foreign('id')->references('id')->on('users');
        });
    }
}
