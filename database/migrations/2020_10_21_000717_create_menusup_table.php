<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menusup', function (Blueprint $table) {
            $table->id();
            $table->string('btn', 150)->nullable();
            $table->string('route', 150)->nullable();
            $table->unsignedInteger('padre')->default(0);
            $table->string('icono', 150)->nullable();
            $table->smallInteger('orden')->default(0);
            $table->boolean('activado')->default(1);
            $table->string('tipo')->nullable();
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
        Schema::dropIfExists('menusup');
    }
}
