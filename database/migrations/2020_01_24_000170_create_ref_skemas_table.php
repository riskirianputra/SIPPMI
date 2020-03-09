<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefSkemasTable extends Migration
{
    public function up()
    {
        Schema::create('ref_skemas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('jenis_usulan')->nullable();
            $table->string('nama')->nullable();
            $table->integer('jangka_waktu')->nullable();
            $table->decimal('biaya_minimal', 15, 2)->nullable();
            $table->decimal('biaya_maksimal', 15, 2)->nullable();
            $table->string('sumber_dana')->nullable();
            $table->integer('anggota_min')->default(0);
            $table->integer('anggota_max')->default(0);
            $table->integer('mahasiswa_min')->default(0);
            $table->integer('mahasiswa_max')->default(0);
            $table->string('jabatan_ketua_min')->nullable();
            $table->string('jabatan_ketua_max')->nullable();
            $table->string('jabatan_anggota_min')->nullable();
            $table->string('jabatan_anggota_max')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
    }
}
