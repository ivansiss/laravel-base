<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageTarjetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_tarjeta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('image_id')->references('id')->on('images')->onDelete('cascade');
            $table->foreignId('tarjeta_id')->references('id')->on('tarjetas')->onDelete('cascade');
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
        Schema::dropIfExists('image_tarjeta');
    }
}
