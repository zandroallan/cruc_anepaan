<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Models\Backend\T_Registro;
use App\Http\Models\Backend\T_Tramite;
use App\Http\Models\Backend\T_Tramite_Rep_Tecnico;
use App\Http\Models\Catalogos\C_Especialidad;

class ApiController extends BaseController
 {
    public function __construct()
     {

     }

     public function test(Request $request)
     {
        $vstatus=200;
        $vrespuesta=array();
        $vrespuesta=['codigo' => 0, 'mensaje' => 'No se encontraron resultados para el RFC ingresado. Verifique que sea correcto e intente nuevamente.'];

        $validator = Validator::make($request->all(), [
            'rfc' => [
                'required',
                'regex:/^([A-ZÑ&]{3,4})(\d{2})(\d{2})(\d{2})([A-Z\d]{3})?$/i'
            ]
        ], [
            'rfc.regex' => 'El RFC no tiene un formato válido. Asegúrate de incluir 12 o 13 caracteres con la estructura correcta.'
        ]);

        if ( $validator->fails() ) {
            return response()->json([
                'codigo'=>0,
                'icono'=>'warning',
                'mensaje'=> $validator->errors()
            ], 201);
        }
        try {
            $_MDL_DATA_Registro=T_Registro::padronShowApi(['rfc'=> $request->rfc])->first();
            if ( $_MDL_DATA_Registro ) {
                $vrespuesta['id_user']=auth('sanctum')->user()->id;
                $vrespuesta=['codigo' => 1, 'mensaje' => 'Exito', 'data' =>$_MDL_DATA_Registro];
            }
        }
        catch( Exception $vexception ) {
            $vrespuesta=['codigo' => -1, 'mensaje' => $vexception->getMessage()];
            $vstatus=500;
        }
        return response()->json($vrespuesta, $vstatus);
     }

    public function registroShow(Request $request)
     {
        $vstatus=200;
        $vrespuesta=array();
        $vrespuesta=['codigo' => 0, 'mensaje' => 'No se encontraron resultados para el RFC ingresado. Verifique que sea correcto e intente nuevamente.'];

        $validator = Validator::make($request->all(), [
            'rfc' => [
                'required',
                'regex:/^([A-ZÑ&]{3,4})(\d{2})(\d{2})(\d{2})([A-Z\d]{3})?$/i'
            ]
        ], [
            'rfc.regex' => 'El RFC no tiene un formato válido. Asegúrate de incluir 12 o 13 caracteres con la estructura correcta.'
        ]);

        if ( $validator->fails() ) {
            return response()->json([
                'codigo'=>0,
                'icono'=>'warning',
                'mensaje'=> $validator->errors()
            ], 201);
        }
        try {
            $_MDL_DATA_Registro=T_Registro::padronShowApi(['rfc'=> $request->rfc])->first();
            if ( $_MDL_DATA_Registro ) {
                // $vrespuesta['id_user']=auth('sanctum')->user()->id;
                $vrespuesta=['codigo' => 1, 'mensaje' => 'Exito', 'data' =>$_MDL_DATA_Registro];
            }
        }
        catch( Exception $vexception ) {
            $vrespuesta=['codigo' => -1, 'mensaje' => $vexception->getMessage()];
            $vstatus=500;
        }
        return response()->json($vrespuesta, $vstatus);
     }

    public function padron( $anio )
     {
        $vstatus=200;
        $vrespuesta=array();
        $vrespuesta=['codigo' => 1, 'mensaje' => 'Ok'];
        try {
            $vrespuesta['data']=T_Tramite::consulta_portal(['anio'=>$anio])->get();
        }
        catch( Exception $vexception ) {
            DB::rollback();
            $vstatus=500;
            $vrespuesta=['codigo' => -1, 'mensaje' => $vexception->getMessage()];
        }
        return response()->json($vrespuesta, $vstatus);
     }

    public function padronDetalle( $id_tramite )
     {
        $vstatus=200;
        $vrespuesta=array();
        $vrespuesta=['codigo' => 1, 'mensaje' => 'Ok'];
        try {
            $datosTramite=T_Tramite::consulta_portal(['id_tramite'=>$id_tramite])->first();
            
            $arrayEspContratista=array();
            if (isset($datosTramite->esp_contratista)) {
                $jsonEsp_Contratista=json_decode($datosTramite->esp_contratista);
                foreach ($jsonEsp_Contratista as $key => $value) {
                    // code...
                    $datosEspecialidad=C_Especialidad::findOrFail($value);
                    array_push($arrayEspContratista, $datosEspecialidad);
                    unset($datosEspecialidad);
                }
            }

            $arrayEspRTEC=array();
            $datosRepTecnicos=T_Tramite_Rep_Tecnico::getRepresentantesTecnico(['id_tramite'=>$id_tramite])->get();
            foreach ($datosRepTecnicos as $key => $value) {
                // code...
                $arrayEsp=array();
                $jsonEsp_RTEC=json_decode($value->especialidades);
                foreach ($jsonEsp_RTEC as $key_ii => $value_ii) {
                    // code...
                    $datosEspecialidad=C_Especialidad::findOrFail($value_ii);
                    array_push($arrayEsp, $datosEspecialidad);
                    unset($datosEspecialidad);
                }

                $arrayEspRTECForeach=array();
                $arrayEspRTECForeach['rtec']=$value;
                $arrayEspRTECForeach['especialidades']=$arrayEsp;
                array_push($arrayEspRTEC, $arrayEspRTECForeach);
                unset($arrayEspRTECForeach);
            }
            
            $vrespuesta['detalle']=$datosTramite;
            $vrespuesta['esp_contratista']=$arrayEspContratista;
            $vrespuesta['esp_rtec']=$arrayEspRTEC;
        }
        catch( Exception $vexception ) {
            DB::rollback();
            $vstatus=500;
            $vrespuesta=['codigo' => -1, 'mensaje' => $vexception->getMessage()];
        }
        return response()->json($vrespuesta, $vstatus);
     }



 }
