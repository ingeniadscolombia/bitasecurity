<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfiles extends Model
{
    //nombre de la tabla en mysql
    protected $table = 'perfiles';

    // Eloquent asume que cada tabla tiene una clave primaria con una columna llamada id.
    // protected $primaryKey = 'id';

    // Atributos que se pueden asignar de manera masiva.    
    protected $fillable = array('nombrePerfil','descripcion');
    
    // Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
    protected $hidden = ['created_at','updated_at']; 
    
    // Relación de usuarios con usuarios:
	public function usuarios()
	{	
		// 1 perfil tiene muchos usuarios
		// $this hace referencia al objeto que tengamos en ese momento de perfiles.
		return $this->hasMany('App\Usuarios');
    }
    
}
