<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTarjetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarjetas', function (Blueprint $table) {
            $table->id();
            $table->string('pagina');
            $table->integer('orden');
            $table->foreignId('category_id')->constrained();// <-- DEFINE LA RESTRICCION DE LLAVE FORANEA
            $table->string('title')->nullable();
            $table->string('subtitulo')->nullable();
            $table->string('url_clean')->nullable();
            $table->text('content')->nullable();
            $table->enum('posted', ['yes', 'not'])->default('not');
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
        Schema::dropIfExists('tarjetas');
    }
}
