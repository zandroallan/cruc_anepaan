<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Models\Backend\T_Registro;

class ApiController extends BaseController
 {
    public function __construct()
     {

     }

    public function test(Request $request)
     {
        $vstatus=200;
        $vrespuesta=array();
        $vrespuesta=['codigo' => 1, 'mensaje' => 'Exito'];

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
           
            $vrespuesta['id_user']=auth('sanctum')->user()->id;
            $vrespuesta['data']=T_Registro::general(['rfc'=> $request->rfc])->first();

        }
        catch( Exception $vexception ) {
            $vrespuesta=['codigo' => -1, 'mensaje' => $vexception->getMessage()];
            $vstatus=500;
        }
        return response()->json($vrespuesta, $vstatus);
     }

 }
