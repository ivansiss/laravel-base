<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo', function (Blueprint $table) {
            $table->id();
            $table->string('pagina');
            $table->string('titulo')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('autor')->nullable();
            $table->string('h1')->nullable();
            $table->string('h2')->nullable();
            $table->integer('orden')->nullable();
            $table->string('extra')->nullable();
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
        Schema::table('seo', function (Blueprint $table) {
            Schema::dropIfExists('seo');
        });
    }
}
