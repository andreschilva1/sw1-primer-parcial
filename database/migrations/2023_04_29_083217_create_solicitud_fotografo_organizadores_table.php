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
            $table->unsignedBigInteger('emisor');
            $table->unsignedBigInteger('receptor');
            $table->String('estado');

            $table->unsignedBigInteger('organizadores_id');
            $table->foreign('organizadores_id')->references('id')->on('organizadores');
            
            $table->unsignedBigInteger('fotografos_id');
            $table->foreign('fotografos_id')->references('id')->on('fotografos');
            
            $table->unsignedBigInteger('eventos_id');
            $table->foreign('eventos_id')->references('id')->on('eventos')->onUpdate('cascade')->onDelete('cascade');

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
