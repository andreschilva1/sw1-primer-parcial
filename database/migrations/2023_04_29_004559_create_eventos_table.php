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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('direccion')->nullable();
            $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->string('photo_path', 2048)->nullable();
            $table->string('ubicacion')->nullable();
            $table->unsignedBigInteger('organizadores_id');
            $table->foreign('organizadores_id')->references('id')->on('organizadores');
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
        Schema::dropIfExists('eventos');
    }
};
