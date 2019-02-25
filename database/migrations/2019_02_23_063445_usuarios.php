<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Usuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('cedula');
            $table->string('direccion');
            $table->string('fechaInicio');
            $table->string('fechaVencimiento');
            $table->string('clave');
            $table->string('usuario');
            $table->string('email');

            // añadir llave foranea
            $table->integer('id_perfil')->unsigned();
            $table->integer('id_contrato')->unsigned();
            $table->integer('id_ciudad')->unsigned();
			// Indicamos cual es la clave foránea de esta tabla:
            $table->foreign('id_perfil')->references('id')->on('perfiles')->onDelete('cascade')->onUpdate("cascade");
            $table->foreign('id_contrato')->references('id')->on('contratos')->onDelete('cascade')->onUpdate("cascade");
            $table->foreign('id_ciudad')->references('id')->on('ciudades')->onDelete('cascade')->onUpdate("cascade");

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
        Schema::dropIfExists('usuarios');
    }
}
