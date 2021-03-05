<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFooterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footer', function (Blueprint $table) {
            $table->id();
            $table->string('empresa', 200);
            $table->text('texto');
            $table->string('novedades1', 200)->nullable();
            $table->string('novedades2', 200)->nullable();
            $table->string('novedades3', 200)->nullable();
            $table->string('enlace1', 200)->nullable();
            $table->string('enlace2', 200)->nullable();
            $table->string('enlace3', 200)->nullable();
            $table->string('direccion', 200)->nullable();
            $table->string('email', 200)->nullable();
            $table->string('telefono', 200)->nullable();
            $table->string('fax', 200)->nullable();
            $table->text('horario')->nullable();
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
        Schema::dropIfExists('footer');
    }
}
