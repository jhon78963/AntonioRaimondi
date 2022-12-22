<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('semestres_academicos', function (Blueprint $table) {
            $table->bigIncrements('seme_id');
            $table->string('seme_descripcion');
            $table->string('seme_estado');
            $table->BigInteger('peri_id');
            $table->foreign('peri_id')->references('peri_id')->on('periodos_academicos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('semestres_academicos');
    }
};