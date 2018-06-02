<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp("fecha_inicio");
            $table->timestamp("fecha_fin")->nullable();
            $table->string('descripcion', 60);
            $table->string('dia_semana', 60);
            $table->unsignedInteger('dia_id');
            $table->foreign('dia_id')->references('id')->on('dias');
            $table->unsignedInteger('sala_id');
            $table->foreign('sala_id')->references('id')->on('salas');
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
        Schema::dropIfExists('reservas');
    }
}
