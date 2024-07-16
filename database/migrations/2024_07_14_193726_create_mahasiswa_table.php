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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignUuid('user_id');
            $table->string('name');
            $table->string('foto');
            $table->integer('nim');
            $table->integer('hp');
            $table->integer('dosen_pembimbing_kp')->unsigned();
            $table->integer('dosen_pembimbing_tga_1')->unsigned();
            $table->integer('dosen_pembimbing_tga_2')->unsigned();
            $table->integer('dosen_penguji_tga_1')->unsigned();
            $table->integer('dosen_penguji_tga_2')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('dosen_pembimbing_kp')->references('id')->on('dosen')->onDelete('restrict');
            $table->foreign('dosen_pembimbing_tga_1')->references('id')->on('dosen')->onDelete('restrict');
            $table->foreign('dosen_pembimbing_tga_2')->references('id')->on('dosen')->onDelete('restrict');
            $table->foreign('dosen_penguji_tga_1')->references('id')->on('dosen')->onDelete('restrict');
            $table->foreign('dosen_penguji_tga_2')->references('id')->on('dosen')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
