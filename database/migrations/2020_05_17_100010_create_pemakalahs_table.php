<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemakalahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemakalahs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tahun');
            $table->string('nama_forum');
            $table->text('judul');
            $table->integer('status_pemakalah')->default(1);
            $table->string('penyelenggara');
            $table->string('tempat')->nullable();
            $table->integer('tingkat')->default(2);
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->string('file_artikel')->nullable();
            $table->integer('verifikasi')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemakalahs');
    }
}
