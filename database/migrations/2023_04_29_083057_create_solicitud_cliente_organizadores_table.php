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
        Schema::create('solicitud_cliente_organizadores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organizadores_id');
            $table->foreign('organizadores_id')->references('id')->on('organizadores');
            
            $table->unsignedBigInteger('clientes_id');
            $table->foreign('clientes_id')->references('id')->on('clientes');
            
            $table->unsignedBigInteger('solicitudes_id');
            $table->foreign('solicitudes_id')->on('solicitudes')->references('id')->onUpdate('cascade')->onDelete('cascade');
            
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
        Schema::dropIfExists('solicitud_cliente_organizadores');
    }
};
