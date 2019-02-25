<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistorialLogueos extends Model
{
    //nombre de la tabla en mysql
    protected $table = 'historialLogueos';

    // Eloquent asume que cada tabla tiene una clave primaria con una columna llamada id.
    // protected $primaryKey = 'id';

    // Atributos que se pueden asignar de manera masiva.    
    protected $fillable = array('accion');
    
    // Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
    protected $hidden = ['created_at','updated_at']; 
    
    // Relación de usuarios con historialLogueos:
	public function usuarios()
	{	
		// 1 usuario tiene muchos historialLogueos
		// $this hace referencia al objeto que tengamos en ese momento de historialLogueos.
		return $this->belongsTo('App\Usuarios');
    }
}
