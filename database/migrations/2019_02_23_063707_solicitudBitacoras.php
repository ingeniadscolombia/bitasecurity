<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SolicitudBitacoras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudBitacoras', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->date('fechaVencimiento');
            $table->string('numeroRegistro');
            $table->string('numeroFoleo');
            $table->text('observaciones');
            $table->string('srcDocumentoSoporte');

            // Añadimos la clave foránea 
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
        Schema::dropIfExists('solicitudBitacoras');
    }
}