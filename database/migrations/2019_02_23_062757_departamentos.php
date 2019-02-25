<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Departamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('codigoDian');

            // añadimos llave foranea
            $table->integer('pais_id')->unsigned();
			// Indicamos cual es la clave foránea de esta tabla:
			$table->foreign('pais_id','paises')->references('id')->on('paises')->onDelete('cascade')->onUpdate("cascade");

            $table->timestamps();
            
        });

        // Insert some stuff
        DB::table('departamentos')->insert(array('id' => NULL, 'codigoDian' => '05', 'nombre' => 'ANTIOQUIA', 'pais_id' => '1'));
        DB::table('departamentos')->insert(array('id' => NULL, 'codigoDian' => '08', 'nombre' => 'ATLANTICO', 'pais_id' => '1'));
        DB::table('departamentos')->insert(array('id' => NULL, 'codigoDian' => '11', 'nombre' => 'BOGOTA', 'pais_id' => '1'));	
        DB::table('departamentos')->insert(array('id' => NULL, 'codigoDian' => '13', 'nombre' => 'BOLIVAR', 'pais_id' => '1'));	
        DB::table('departamentos')->insert(array('id' => NULL, 'codigoDian' => '15', 'nombre' => 'BOYACA', 'pais_id' => '1'));	
        DB::table('departamentos')->insert(array('id' => NULL, 'codigoDian' => '17', 'nombre' => 'CALDAS', 'pais_id' => '1'));	
        DB::table('departamentos')->insert(array('id' => NULL, 'codigoDian' => '18', 'nombre' => 'CAQUETA', 'pais_id' => '1'));	
        DB::table('departamentos')->insert(array('id' => NULL, 'codigoDian' => '19', 'nombre' => 'CAUCA', 'pais_id' => '1'));	
        DB::table('departamentos')->insert(array('id' => NULL, 'codigoDian' => '20', 'nombre' => 'CESAR', 'pais_id' => '1'));	
        DB::table('departamentos')->insert(array('id' => NULL, 'codigoDian' => '23', 'nombre' => 'CORDOBA', 'pais_id' => '1'));	
        DB::table('departamentos')->insert(array('id' => NULL, 'codigoDian' => '25', 'nombre' => 'CUNDINAMARCA', 'pais_id' => '1'));	
        DB::table('departamentos')->insert(array('id' => NULL, 'codigoDian' => '27', 'nombre' => 'CHOCO', 'pais_id' => '1'));	
        DB::table('departamentos')->insert(array('id' => NULL, 'codigoDian' => '41', 'nombre' => 'HUILA', 'pais_id' => '1'));	
        DB::table('departamentos')->insert(array('id' => NULL, 'codigoDian' => '44', 'nombre' => 'LA GUAJIRA', 'pais_id' => '1'));	
        DB::table('departamentos')->insert(array('id' => NULL, 'codigoDian' => '47', 'nombre' => 'MAGDALENA', 'pais_id' => '1'));	
        DB::table('departamentos')->insert(array('id' => NULL, 'codigoDian' => '50', 'nombre' => 'META', 'pais_id' => '1'));	
        DB::table('departamentos')->insert(array('id' => NULL, 'codigoDian' => '52', 'nombre' => 'NARIÑO', 'pais_id' => '1'));	
        DB::table('departamentos')->insert(array('id' => NULL, 'codigoDian' => '54', 'nombre' => 'N. DE SANTANDER', 'pais_id' => '1'));	
        DB::table('departamentos')->insert(array('id' => NULL, 'codigoDian' => '63', 'nombre' => 'QUINDIO', 'pais_id' => '1'));	
        DB::table('departamentos')->insert(array('id' => NULL, 'codigoDian' => '66', 'nombre' => 'RISARALDA', 'pais_id' => '1'));	
        DB::table('departamentos')->insert(array('id' => NULL, 'codigoDian' => '68', 'nombre' => 'SANTANDER', 'pais_id' => '1'));	
        DB::table('departamentos')->insert(array('id' => NULL, 'codigoDian' => '70', 'nombre' => 'SUCRE', 'pais_id' => '1'));	
        DB::table('departamentos')->insert(array('id' => NULL, 'codigoDian' => '73', 'nombre' => 'TOLIMA', 'pais_id' => '1'));	
        DB::table('departamentos')->insert(array('id' => NULL, 'codigoDian' => '76', 'nombre' => 'VALLE DEL CAUCA', 'pais_id' => '1'));	
        DB::table('departamentos')->insert(array('id' => NULL, 'codigoDian' => '81', 'nombre' => 'ARAUCA', 'pais_id' => '1'));	
        DB::table('departamentos')->insert(array('id' => NULL, 'codigoDian' => '85', 'nombre' => 'CASANARE', 'pais_id' => '1'));	
        DB::table('departamentos')->insert(array('id' => NULL, 'codigoDian' => '86', 'nombre' => 'PUTUMAYO', 'pais_id' => '1'));	
        DB::table('departamentos')->insert(array('id' => NULL, 'codigoDian' => '88', 'nombre' => 'SAN ANDRES', 'pais_id' => '1'));	
        DB::table('departamentos')->insert(array('id' => NULL, 'codigoDian' => '91', 'nombre' => 'AMAZONAS', 'pais_id' => '1'));	
        DB::table('departamentos')->insert(array('id' => NULL, 'codigoDian' => '94', 'nombre' => 'GUAINIA', 'pais_id' => '1'));	
        DB::table('departamentos')->insert(array('id' => NULL, 'codigoDian' => '95', 'nombre' => 'GUAVIARE', 'pais_id' => '1'));	
        DB::table('departamentos')->insert(array('id' => NULL, 'codigoDian' => '97', 'nombre' => 'VAUPES', 'pais_id' => '1'));	
        DB::table('departamentos')->insert(array('id' => NULL, 'codigoDian' => '99', 'nombre' => 'VICHADA', 'pais_id' => '1'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departamentos');
    }
}
