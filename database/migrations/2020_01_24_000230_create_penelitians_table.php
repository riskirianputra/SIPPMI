<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenelitiansTable extends Migration
{
    public function up()
    {
        Schema::create('penelitians', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('kode_rumpun_id')->nullable();
            $table->unsignedInteger('prodi_id');
            $table->string('judul');
            $table->unsignedInteger('skema_id')->nullable();
            $table->unsignedInteger('tahapan_id')->nullable();
            $table->integer('fokus_id')->nullable();
            $table->longText('ringkasan_eksekutif')->nullable();
            $table->decimal('biaya', 15, 2)->nullable();
            $table->decimal('biaya_final', 15, 2)->nullable();
            $table->integer('status_penelitian')->nullable();
            $table->string('multi_tahun')->nullable();
            $table->integer('tahun')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('file_cv')->nullable();
            $table->string('file_pengesahan')->nullable();
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
            $table->foreign('tahapan_id')->references('id')->on('rip_tahapans');
        });
    }
}
