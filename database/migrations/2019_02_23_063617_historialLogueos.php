<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HistorialLogueos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historialLogueos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('accion');

            // añadimos llave foranea
            $table->integer('id_usuario')->unsigned();
			// Indicamos cual es la clave foránea de esta tabla:
			$table->foreign('id_usuario')->references('id')->on('usuarios')->onDelete('cascade')->onUpdate("cascade");

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
        Schema::dropIfExists('historialLogueos');
    }
}
