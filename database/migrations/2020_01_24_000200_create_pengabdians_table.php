<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengabdiansTable extends Migration
{
    public function up()
    {
        Schema::create('pengabdians', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('skema_id');
            $table->unsignedInteger('kode_rumpun_id')->nullable();
            $table->unsignedInteger('prodi_id')->nullable();
            $table->string('judul');
            $table->string('mitra_pengabdian')->nullable();
            $table->longText('ringkasan_eksekutif')->nullable();
            $table->integer('status_pengabdian')->nullable();
            $table->string('multi_tahun')->nullable();
            $table->integer('tahun_ke')->nullable();
            $table->decimal('biaya', 15, 2)->nullable();
            $table->string('file_proposal')->nullable();
            $table->string('file_lap_progress')->nullable();
            $table->string('file_lap_keuangan')->nullable();
            $table->string('file_lap_akhir')->nullable();
            $table->string('file_profil')->nullable();
            $table->string('file_logbook')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('kode_rumpun_id')->references('id')->on('kode_rumpuns');
            $table->foreign('prodi_id')->references('id')->on('prodis');
            $table->foreign('skema_id')->references('id')->on('ref_skemas');
        });
    }
}
