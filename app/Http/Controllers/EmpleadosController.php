<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Modelos
use App\Models\{Empleado, Habilidad, Puesto};
// Necesitamos la clase Response para crear la respuesta especial con la cabecera de localización en el método Store()
use Response;
use Carbon\Carbon;
use Validator;

class EmpleadosController extends Controller
{
   public function __construct()
	{
	   $this->middleware('auth.basic',['only'=>['store','show']]);
	}
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      return response()->json(['estatus'=>'empleados activos','data'=>Empleado::select('id', 'nombre', 'ap_paterno', 'ap_materno')->where('activo', 1)->get()], 200);
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
      $rules = [
         'nombre' => ['required','max:80', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ.\s]/'],
            'ap_paterno' => ['required','max:80', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ.\s]/'],
            'ap_materno' => ['max:80', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ.\s]/'],
            'puesto_id' => ['required', 'numeric'],
            'fecha_nacimiento' => ['required', 'date_format:d-m-Y'],
            'cp' => ['required', 'regex:/^[0-9]{5}/'],
            'calle' => ['required', 'string'],
            'numero' =>  ['required', 'string'],
            'colonia' =>  ['required', 'string'],
            'del_mun' => ['required', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ.\s]/'],
            'estado' => ['required', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ.\s]/'],
            'habilidad' => ['required', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ.\s]/'],
            // 'calificacion' => ['required', 'digits_between:1,5'];
         ];
         $validator = Validator::make($request->all(), $rules);
         if ($validator->fails()) {
            return response()->json(['errors'=>array(['code'=>422, 'message'=>"Error en campo(s)".$validator->errors()])],422);
         }
         else {
            $fecha = $request->input('fecha_nacimiento');
            $fechaNac = explode('-',$fecha);
            $day = $fechaNac[0];
            $mounth = $fechaNac[1];
            $year = $fechaNac[2];
            $fechaNac = $year."-".$mounth."-".$day;
            $datos = $request->all();

            $datos['fecha_nacimiento']=$fechaNac;
            $habilidad = array();
            if(array_key_exists('habilidad', $datos)){
               $habilidad = ['nombre' => $datos['habilidad'], 'calificacion' => (int)$datos['calificacion']];
               unset($datos['habilidad']);
               unset($datos['calificacion']);

            }
            $empleado = Empleado::create($datos);
            $habilidad["empleado_id"] = $empleado->id;
            $habilidad = Habilidad::create($habilidad);
            return response()->json(['success'=>'ok', 'msg'=>"empleado registrado"], 200);
         }
   }

   public function show($id)
   {
      $empleado = Empleado::find($id);

      // Si no existe el usuario devolvemos un error.

		if (!$empleado)
		{
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No existe un empleado registrado con el id '.$id.' .'])],404);
		}
      $msj['datos personales'] = $empleado;
      $habilidades=Habilidad::select('nombre', 'calificacion')->where('empleado_id', $id)->get();
      $msj['habilidades']=$habilidades;
		return response()->json($msj, 200, [], JSON_UNESCAPED_SLASHES);
    }
}
