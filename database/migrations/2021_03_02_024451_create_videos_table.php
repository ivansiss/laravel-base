<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('miniatura')->nullable();;
            $table->text('descripcion')->nullable();;
            $table->string('link')->nullable();;
            $table->integer('visible');
            $table->foreignId('tipo_id')->constrained('tipo_video');// <-- DEFINE LA RESTRICCION DE LLAVE FORANEA
            $table->string('size')->nullable();;
            $table->integer('orden')->nullable();;
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
        Schema::dropIfExists('videos');
    }
}
