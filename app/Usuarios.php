<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    //nombre de la tabla en mysql
    protected $table = 'usuarios';

    // Eloquent asume que cada tabla tiene una clave primaria con una columna llamada id.
    // protected $primaryKey = 'id';

    // Atributos que se pueden asignar de manera masiva.
    
    protected $fillable = array('nombre','cedula','direccion','fechaInicio','fechaVencimiento','clave','usuario','email');
    
    // Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
    protected $hidden = ['created_at','updated_at']; 
    
    // Relación de usuarios con perfiles:
	public function perfiles()
	{	
		// 1 perfil tiene muchos usuarios
		// $this hace referencia al objeto que tengamos en ese momento de Usuario.
		return $this->belongsTo('App\Perfiles');
    }
    
    // Relación de usuarios con contratos:
	public function contratos()
	{	
		// 1 usuario tiene muchos Contratos
		// $this hace referencia al objeto que tengamos en ese momento de Usuario.
		return $this->belongsTo('App\Contratos');
	}

    // Relación de usuarios con ciudad:
	public function ciudades()
	{	
		// 1 ciudad tiene muchos Usuarios
		// $this hace referencia al objeto que tengamos en ese momento de Usuario.
		return $this->belongsTo('App\Ciudades');
	}

	// Relación de usuarios con telefonos:
	public function telefonos()
	{	
		// 1 usuario tiene muchos telefonos
		// $this hace referencia al objeto que tengamos en ese momento de Usuario.
		return $this->hasMany('App\Telefonos');
	}
	
	// Relación de usuarios con solicitudbitacoras:
	public function solicitudbitacoras()
	{	
		// 1 usuario tiene muchos solicitudbitacoras
		// $this hace referencia al objeto que tengamos en ese momento de Usuario.
		return $this->hasMany('App\SolicitudBitacoras');
	}

	// Relación de usuarios con historialLogueos:
	public function historialLogueos()
	{	
		// 1 usuario tiene muchos historialLogueos
		// $this hace referencia al objeto que tengamos en ese momento de Usuario.
		return $this->hasMany('App\HistorialLogueos');
	}

}
