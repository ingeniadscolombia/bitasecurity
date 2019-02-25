<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Usuarios;
use App\Telefonos;

class UsuariosController extends Controller
{
    // Configuramos en el constructor del controlador la autenticación usando el Middleware auth.basic,
	// pero solamente para los métodos de crear, actualizar y borrar.
	public function __construct()
	{
		$this->middleware('auth.basic',['only'=>['store','update','destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Devolvera todos los usuarios
        return response()->json(['status'=>'ok','data'=>Usuarios::all()], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // primero comprobar si esta recibiendo todos los datos necesarios
        if( !$request->input('nombre') || !$request->input('cedula') || !$request->input('direccion')
            || !$request->input('fechaInicio') || !$request->input('fechaVencimiento')  || !$request->input('clave')
            || !$request->input('usuario') || !$request->input('email') ){
                
            // Se devuelve un array errors con los errores encontrados y cabecera HTTP 422 Unprocessable Entity – [Entidad improcesable] Utilizada para errores de validación.
			// En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
			return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan datos necesarios para el proceso de alta.'])],422);
        }
        else if( !$request->input('id_perfil') || !$request->input('id_contrato') || !$request->input('id_ciudad') ){
            // Se devuelve un array errors con los errores encontrados y cabecera HTTP 422 Unprocessable Entity – [Entidad improcesable] Utilizada para errores de validación.
			// En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
			return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan primordiales para el proceso de alta.'])],422);
        }
        
        // Insertamos una fila en Usuarios con create pasándole todos los datos recibidos.
		// En $request->all() tendremos todos los campos del formulario recibidos.
        $nuevoUsuario = Usuarios::create($request->all());
        // clave md5 y sha
        $nuevoUsuario->clave = md5($nuevoUsuario->clave);
        $nuevoUsuario->save();
        // comprobar telefonos
        if( $request->input('telefonos') ){ //split (,)
            $telefonos = explode(',',$request->input('telefonos'));
            foreach ($telefonos as $telefono) {
                $obj = new Telefonos();
                $obj->numTelefono   = $telefono;
                $obj->id_usuario    = $nuevoUsuario->id;
                $obj->save(); 
            }
        }

        // Respuesta de una creacion
        $response = Response::make(json_encode(['data'=>$nuevoUsuario]), 201)->header('Location', 'http://localhost/usuarios/'.$nuevoUsuario->id)->header('Content-Type', 'application/json');
		return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return "Se muestra usuario con id: $id";
		// Buscamos un usuario por el id.
        $usuarios = Usuarios::find($id);
        $telefonos = Telefonos::find($usuarios->id);

        // Si no existe ese usuarios devolvemos un error.
		if (!$usuarios)
		{
			// Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
			// En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un usuarios con ese código.'])],404);
		}

		return response()->json(['status'=>'ok','data'=>$usuarios,'telefonos'=>$telefonos],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Comprobamos si el usuario que nos están pasando existe o no.
		$usuario = Usuarios::find($id);

		// Si no existe ese usuario devolvemos un error.
		if (!$usuarios)
		{
			// Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
			// En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un usuario con ese código.'])],404);
		}		

		// Necesitamos detectar si estamos recibiendo una petición PUT o PATCH.
		// El método de la petición se sabe a través de $request->method();
		if ($request->method() === 'PUT' || $request->method() === 'PATCH')
		{
			// Creamos una bandera para controlar si se ha modificado algún dato en el método PUT.
			$bandera = false;

            
			// Actualización parcial de campos.
			if ($request->input('nombre')){
				$usuario->nombre = $request->input('nombre');
				$bandera=true;
            }
            if ($request->input('cedula')){
				$usuario->cedula = $request->input('cedula');
				$bandera=true;
            }
            if ($request->input('direccion')){
				$usuario->direccion = $request->input('direccion');
				$bandera=true;
            }
            if ($request->input('fechaInicio')){
				$usuario->fechaInicio = $request->input('fechaInicio');
				$bandera=true;
            }
            if ($request->input('fechaVencimiento')){
				$usuario->fechaVencimiento = $request->input('fechaVencimiento');
				$bandera=true;
            }
            if ($request->input('clave')){
                $usuario->clave = md5($request->input('clave'));
				$bandera=true;
            }
            if ($request->input('usuario')){
				$usuario->usuario = $request->input('usuario');
				$bandera=true;
            }
            if ($request->input('email')){
				$usuario->email = $request->input('email');
				$bandera=true;
            }
            if ($request->input('id_perfil')){
				$usuario->id_perfil = $request->input('id_perfil');
				$bandera=true;
            }
            if ($request->input('id_contrato')){
				$usuario->id_contrato = $request->input('id_contrato');
				$bandera=true;
            }
            if ($request->input('id_ciudad')){
				$usuario->id_ciudad = $request->input('id_ciudad');
				$bandera=true;
			}

			
			if ($bandera)
			{
				// Almacenamos en la base de datos el registro.
				$usuario->save();
				return response()->json(['status'=>'ok','data'=>$usuario], 200);
			}
			else
			{
				// Se devuelve un array errors con los errores encontrados y cabecera HTTP 304 Not Modified – [No Modificada] Usado cuando el cacheo de encabezados HTTP está activo
				// Este código 304 no devuelve ningún body, así que si quisiéramos que se mostrara el mensaje usaríamos un código 200 en su lugar.
				return response()->json(['errors'=>array(['code'=>304,'message'=>'No se ha modificado ningún dato de fabricante.'])],304);
			}
        }
        else
        {
            // metodo no corresponde 
            return response()->json(['errors'=>array(['code'=>404,'message'=>'El metodo para enviar datos debe ser PUT.'])],404);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Comprobamos si el usuario que nos están pasando existe o no.
		$usuario = Usuarios::find($id);

		// Si no existe ese usuario devolvemos un error.
		if (!$usuario)
		{
			// Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
			// En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un usuarios con ese código.'])],404);
		}		

		// El usuario existe entonces buscamos el avion que queremos borrar asociado a ese fabricante.
		$telefono = $usuario->telefonos()->find($id_usuario);

		// Si no existe ese avión devolvemos un error.
		if (!$telefono)
		{
			// Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
			// En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un telefono con ese código asociado a ese fabricante.'])],404);
		}

		// Procedemos por lo tanto a eliminar el avión.
		$usuario->delete();

		// Se usa el código 204 No Content – [Sin Contenido] Respuesta a una petición exitosa que no devuelve un body (como una petición DELETE)
		// Este código 204 no devuelve body así que si queremos que se vea el mensaje tendríamos que usar un código de respuesta HTTP 200.
		return response()->json(['code'=>204,'message'=>'Se ha eliminado el usuario correctamente.'],204);

    }

    /**
     * loguin usuario
     */
    public function loguin(Request $request)
    {
        if(!$request->input('usuario') || !$request->input('clave') )
        {
            return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan datos necesarios para el proceso de alta.'])],422);
        }

        // Si el usuario existe
        $usuarios = Usuarios::where('usuario','like',$request->input('usuario'))->where('clave','like',md5($request->input('clave')))->get();

        // Si no existe ese usuarios devolvemos un error.
		if (!$usuarios)
		{
			// Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
			// En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un usuarios con ese código.'])],404);
		}

		return response()->json(['status'=>'ok','data'=>$usuarios],200);
    }

    /**
     * recordar contraseña
     */
    public function recordarContraseña(Request $request)
    {

    }
}
