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
        Schema::create('fotografias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('image_url');
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
        Schema::dropIfExists('fotografias');
    }
};
