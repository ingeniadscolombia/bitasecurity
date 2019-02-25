<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefonos extends Model
{
    //nombre de la tabla en mysql
    protected $table = 'telefonos';

    // Eloquent asume que cada tabla tiene una clave primaria con una columna llamada id.
    // protected $primaryKey = 'id';

    // Atributos que se pueden asignar de manera masiva.    
    protected $fillable = array('numTelefono');
    
    // Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
    protected $hidden = ['created_at','updated_at']; 
    
    // Relación de usuarios con usuarios:
	public function usuarios()
	{	
		// 1 usuario tiene muchos telefonos
		// $this hace referencia al objeto que tengamos en ese momento de telefonos.
		return $this->belongsTo('App\Usuarios');
    }
}
