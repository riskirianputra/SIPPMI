<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->string('nama');
            $table->string('nip')->nullable();
            $table->string('email')->unique();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('status')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('telepon')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->primary('id');
            $table->foreign('id')->references('id')->on('users');
        });
    }
}
