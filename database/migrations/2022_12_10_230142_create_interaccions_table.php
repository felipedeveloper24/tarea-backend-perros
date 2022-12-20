<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interaccions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_perro_interesado") ->nullable() ;
            $table-> foreign("id_perro_interesado")-> references("id") -> on("perros");
            $table-> unsignedBigInteger("id_perro_candidato") -> nullable();
            $table->foreign("id_perro_candidato")->references("id") -> on("perros");
            $table->char("preferencia");
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
        Schema::dropIfExists('interaccions');
    }
};
