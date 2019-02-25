<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    //nombre de la tabla en mysql
    protected $table = 'departamentos';

    // Eloquent asume que cada tabla tiene una clave primaria con una columna llamada id.
    // protected $primaryKey = 'id';

    // Atributos que se pueden asignar de manera masiva.
    
    protected $fillable = array('nombre','codigoDian');
    
    // Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
    protected $hidden = ['created_at','updated_at']; 

    // Relación de ciudades con departamentos:
	public function ciudades()
	{	
		// 1 departamento tiene muchos ciudades
		// $this hace referencia al objeto que tengamos en ese momento de Ciudades.
		return $this->hasMany('App\Ciudades');
    }
    
    // Relación de departamentos con paises:
	public function paises()
	{	
		// 1 pais tiene muchos departamentos
		// $this hace referencia al objeto que tengamos en ese momento de departamentos.
		return $this->belongsTo('App\Paises');
	}
}
