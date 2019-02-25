<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudades extends Model
{
    //nombre de la tabla en mysql
    protected $table = 'ciudades';

    // Eloquent asume que cada tabla tiene una clave primaria con una columna llamada id.
    // protected $primaryKey = 'id';

    // Atributos que se pueden asignar de manera masiva.
    
    protected $fillable = array('nombre','codigoDian');
    
    // Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
    protected $hidden = ['created_at','updated_at']; 

    // Relación de usuarios con ciudades:
	public function usuarios()
	{	
		// 1 ciudad tiene muchos Usuarios
		// $this hace referencia al objeto que tengamos en ese momento de Ciudades.
		return $this->hasMany('App\Usuarios');
    }
    
    // Relación de ciudades con departamentos:
	public function departamentos()
	{	
		// 1 departamento tiene muchos ciudades
		// $this hace referencia al objeto que tengamos en ese momento de Ciudades.
		return $this->belongsTo('App\Departamentos');
	}
}
