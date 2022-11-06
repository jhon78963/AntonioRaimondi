<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->bigIncrements('upro_id');
            $table->string('upro_company')->default('Antonio Raimondi');;
            $table->string('upro_email')->nullable();
            $table->string('upro_firstName')->nullable();
            $table->string('upro_lastName')->nullable();
            $table->string('upro_address')->nullable();
            $table->string('upro_city')->nullable();
            $table->string('upro_phoneNumber')->nullable();
            $table->string('upro_country')->nullable();
            $table->string('upro_postalCode')->nullable();
            $table->string('upro_image')->default('/img/fotoperfil/user.png');
            $table->string('upro_aboutMe')->nullable();
            $table->string('role_id')->nullable();
            $table->BigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
};