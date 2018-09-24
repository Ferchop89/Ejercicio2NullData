<?php

namespace App\Http\Controllers;

use App\{TCalificacion, TAlumno, TMateria};
use Illuminate\Http\Request;

// Necesitamos la clase Response para crear la respuesta especial con la cabecera de localización en el método Store()
use Response;
use Carbon\Carbon;

class TCalificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['status'=>'ok','data'=>TCalificacion::all()], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if (!$request->input('id_t_materias') || !$request->input('id_t_usuarios') || !$request->input('calificacion') || !$request->input('fecha_registro'))
      {
          // Se devuelve un array errors con los errores encontrados y cabecera HTTP 422 Unprocessable Entity – [Entidad improcesable] Utilizada para errores de validación.
          return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan datos necesarios para el proceso de alta.'])],422);
      }
      $nuevaCalificacion=TCalificacion::create($request->all());
      return response()->json(['success'=>'ok','msg'=>"calificacion registrada"],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TCalificacion  $tCalificacion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $usuario = TAlumno::find($id);

      // Si no existe el usuario devolvemos un error.

		if (!$usuario)
		{
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No existe un usuario registrado con el id '.$id.' .'])],404);
		}

      $calificaciones=TCalificacion::where('id_t_usuarios', $id)->get();
      $promedio = 0;
      $msj = array();
      $msjs = array();
      foreach ($calificaciones as $key => $value) {
         $promedio = $promedio + $value->calificacion;
         $msj =[
            'id_t_usuario' => $value->alumno->id_t_usuarios,
            'nombre' => $value->alumno->nombre,
            'apellido' => $value->alumno->ap_paterno,
            'materia' => $value->materia->nombre,
            'calificacion' =>$value->calificacion,
            'fecha_registro' => Carbon::parse($value->fecha_registro)->format('d/m/Y'),
         ];
         array_push($msjs, $msj);
      }
      $promedio = $promedio / count($calificaciones);
      $prom = [
         'promedio' => $promedio,
      ];
      array_push($msjs, $prom);
		return response()->json($msjs, 200, [], JSON_UNESCAPED_SLASHES);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TCalificacion  $tCalificacion
     * @return \Illuminate\Http\Response
     */
    public function edit(TCalificacion $tCalificacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TCalificacion  $tCalificacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      // Comprobamos si la calificacion que nos están pasando existe o no.
     $calificacion=TCalificacion::find($id);

     // Si no existe esa calificacion devolvemos un error.
     if (!$calificacion)
     {
        // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
        // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
        return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra una calificacion con el identificador '.$id])],404);
     }

     // Listado de campos recibidos teóricamente.
     $materia=$request->input('id_t_materias');
     $usuario=$request->input('id_t_usuarios');
     $calif=$request->input('calificacion');
     $fecha=$request->input('fecha_registro');

     // Necesitamos detectar si estamos recibiendo una petición PUT o PATCH.
     // El método de la petición se sabe a través de $request->method();
     if ($request->method() === 'PUT')
     {
        if (!$materia || !$usuario || !$calif || !$fecha)
        {
           // Se devuelve un array errors con los errores encontrados y cabecera HTTP 422 Unprocessable Entity – [Entidad improcesable] Utilizada para errores de validación.
           return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan valores para completar el procesamiento.'])],422);
        }
        $idMateria=TMateria::find($materia);
        if(!$idMateria){
           return response()->json(['errors'=>array(['code'=>422,'message'=>'No existe alguna materia con ese identificador.'])],422);
        }
        $idUsuario=TAlumno::find($usuario);
        if(!$idUsuario){
           return response()->json(['errors'=>array(['code'=>422,'message'=>'No existe algun usuario con ese identificador.'])],422);
        }
        $calificacion->id_t_materias = $materia;
        $calificacion->id_t_usuarios = $usuario;
        $calificacion->calificacion = $calif;
        $calificacion->fecha_registro = $fecha;

        // Almacenamos en la base de datos el registro.
        $calificacion->save();
        return response()->json(['success'=>'ok','msg'=> 'calificacion actualizada'], 200);
      }
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TCalificacion  $tCalificacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $calificacion=TCalificacion::find($id);

       // Si no existe esa calificacion devolvemos un error.
       if (!$calificacion)
       {
         // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
         return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra una calificacion con el identificador '.$id])],404);
       }
       // Procedemos a eliminar el registro
       $calificacion->delete();

       // Se usa el código 204 No Content – [Sin Contenido] Respuesta a una petición exitosa que no devuelve un body (como una petición DELETE)
       // Este código 204 no devuelve body así que si queremos que se vea el mensaje tendríamos que usar un código de respuesta HTTP 200.
       return response()->json(['success'=>'ok','msg'=> 'calificacion eliminada'], 200);
       // return response()->json(['code'=>204,'message'=>'Se ha eliminado  correctamente.'],204);

    }
}
