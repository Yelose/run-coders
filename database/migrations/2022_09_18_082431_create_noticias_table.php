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
        Schema::create('noticias', function (Blueprint $table) {
            $table->id();
            $table->string("titular");
            $table->string("imagen");
            $table->string("piefoto");
            $table->string("subtitulo");
            $table->longText("noticia");
            $table->date("fecha");
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('noticias');
    }
};
