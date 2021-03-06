<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Departamentos;

class DepartamentosController extends Controller
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
        // Devolvera todos los departamentos
        return response()->json(['status'=>'ok','data'=>Departamentos::all()], 200);
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
        if( !$request->input('nombre') || !$request->input('codigoDian') || !$request->input('id_pais') ){
                
            // Se devuelve un array errors con los errores encontrados y cabecera HTTP 422 Unprocessable Entity – [Entidad improcesable] Utilizada para errores de validación.
			// En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
			return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan datos necesarios para el proceso de alta.'])],422);
        }

        // Insertamos una fila en departamentos con create pasándole todos los datos recibidos.
		// En $request->all() tendremos todos los campos del formulario recibidos.
		$nuevoDepartamento = Departamentos::create($request->all());

        // Respuesta de una creacion
        $response = Response::make(json_encode(['data'=>$nuevoDepartamento]), 201)->header('Location', 'http://localhost/departamentos/'.$nuevoDepartamento->id)->header('Content-Type', 'application/json');
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
        // return "Se muestra departamentos con id: $id";
		// Buscamos un departamentos por el id.
        $departamentos = Departamentos::find($id);

        // Si no existe ese departamentos devolvemos un error.
		if (!$departamentos)
		{
			// Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
			// En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un departamentos con ese código.'])],404);
		}

		return response()->json(['status'=>'ok','data'=>$departamentos],200);
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
        // Comprobamos si el departamentos que nos están pasando existe o no.
		$departamento = Departamentos::find($id);

		// Si no existe ese departamento devolvemos un error.
		if (!$departamento)
		{
			// Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
			// En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un departamento con ese código.'])],404);
		}		

		// Necesitamos detectar si estamos recibiendo una petición PUT o PATCH.
		// El método de la petición se sabe a través de $request->method();
		if ($request->method() === 'PUT' || $request->method() === 'PATCH')
		{
			// Creamos una bandera para controlar si se ha modificado algún dato en el método PUT.
			$bandera = false;

            
			// Actualización parcial de campos.
			if ($request->input('nombre')){
				$departamento->nombre = $request->input('nombre');
				$bandera=true;
            }
            if ($request->input('codigoDian')){
				$departamento->nombre = $request->input('codigoDian');
				$bandera=true;
            }
            if ($request->input('id_pais')){
				$departamento->nombre = $request->input('id_pais');
				$bandera=true;
            }
			
			if ($bandera)
			{
				// Almacenamos en la base de datos el registro.
				$departamento->save();
				return response()->json(['status'=>'ok','data'=>$departamento], 200);
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
        // Comprobamos si el departamento que nos están pasando existe o no.
		$departamento = Departamentos::find($id);

		// Si no existe ese departamento devolvemos un error.
		if (!$departamento)
		{
			// Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
			// En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un departamento con ese código.'])],404);
		}		

		// Procedemos por lo tanto a eliminar el avión.
		$departamento->delete();

		// Se usa el código 204 No Content – [Sin Contenido] Respuesta a una petición exitosa que no devuelve un body (como una petición DELETE)
		// Este código 204 no devuelve body así que si queremos que se vea el mensaje tendríamos que usar un código de respuesta HTTP 200.
		return response()->json(['code'=>204,'message'=>'Se ha eliminado el departamento correctamente.'],204);

    }
}
