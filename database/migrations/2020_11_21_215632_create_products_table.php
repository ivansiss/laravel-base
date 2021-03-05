<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 300);
            $table->mediumText('resena')->nullable();
            $table->string('subtitulo', 300)->nullable();
            $table->mediumText('contenido')->nullable();
            $table->string('pdf', 150)->nullable();
            $table->decimal('precio_ahora', 7,2)->nullable();
            $table->decimal('precio_antes', 7,2)->nullable();
            $table->decimal('precio_liquidacion', 7,2)->nullable();
            $table->string('estado', 10)->nullable();
            $table->integer('stock')->nullable();
            $table->longText('slug')->nullable();
            $table->integer('num_ventas')->nullable();
            $table->integer('orden')->nullable();
            $table->integer('padre')->nullable();
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
        Schema::dropIfExists('products');
    }
}
