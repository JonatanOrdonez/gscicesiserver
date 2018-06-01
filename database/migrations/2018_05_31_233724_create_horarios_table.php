<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('horarios', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sala_id');
            $table->foreign('sala_id')->references('id')->on('salas');
            $table->unsignedInteger('dia_id');
            $table->foreign('dia_id')->references('id')->on('dias');
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
        Schema::dropIfExists('horarios');
    }
}
