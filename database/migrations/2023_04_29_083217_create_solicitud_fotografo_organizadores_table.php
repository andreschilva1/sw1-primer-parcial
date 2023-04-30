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
        Schema::create('solicitud_fotografo_organizadores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organizadores_id');
            $table->foreign('organizadores_id')->references('id')->on('organizadores');
            $table->unsignedBigInteger('fotografos_id');
            $table->foreign('fotografos_id')->references('id')->on('fotografos');
            $table->unsignedBigInteger('solicitudes_id');
            $table->foreign('solicitudes_id')->on('solicitudes')->references('id')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('solicitud_fotografo_organizadores');
    }
};
