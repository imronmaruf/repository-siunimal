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
        Schema::create('kerja_praktek', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mahasiswa_id')->unsigned();
            $table->integer('dosen_pembimbing')->unsigned();
            $table->text('judul_kp');
            $table->text('latar_belakang');
            $table->string('laporan')->nullable();
            $table->string('link_github')->nullable();
            $table->string('link_gdrive')->nullable();
            $table->string('bukti_distribusi')->nullable();
            $table->string('bukti_nilai')->nullable();
            $table->string('nilai')->nullable();
            $table->timestamps();

            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswa')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('dosen_pembimbing')->references('dosen_pembimbing_kp')->on('mahasiswa')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kerja_praktek');
    }
};
