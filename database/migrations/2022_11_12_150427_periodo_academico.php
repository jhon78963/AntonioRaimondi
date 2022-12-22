<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('periodos_academicos', function (Blueprint $table) {
            $table->bigIncrements('peri_id');
            $table->string('peri_descripcion')->unique();
            $table->string('peri_estado');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('periodos_academicos');
    }
};