<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tugas_akhir', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mahasiswa_id')->unsigned();
            $table->integer('dosen_pembimbing_1')->unsigned();
            $table->integer('dosen_pembimbing_2')->unsigned();
            $table->integer('dosen_penguji_1')->unsigned();
            $table->integer('dosen_penguji_2')->unsigned();
            $table->text('judul_tga');
            $table->text('abstrak');
            $table->string('dokumen')->nullable();
            $table->string('link_github')->nullable();
            $table->string('link_gdrive')->nullable();
            $table->string('ijazah')->nullable();
            $table->string('bukti_distribusi')->nullable();
            $table->timestamps();

            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswa')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('dosen_pembimbing_1')->references('id')->on('dosen')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('dosen_pembimbing_2')->references('id')->on('dosen')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('dosen_penguji_1')->references('id')->on('dosen')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('dosen_penguji_2')->references('id')->on('dosen')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas_akhir');
    }
};
