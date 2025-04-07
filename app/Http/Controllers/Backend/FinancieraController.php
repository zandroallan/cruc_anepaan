<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Models\Backend\D_Personal;
use App\Http\Models\Backend\T_Registro;
use App\Http\Models\Backend\T_Tramite_Capital_Contable;
use App\Http\Models\Backend\T_Tramite_Estado_Financiero;
use App\Http\Models\Backend\T_Tramite_Contador;
use Auth;
use DB;

class FinancieraController extends Controller
 {
    public function __construct() 
     {
        $this->middleware('auth');     
     }

    public function api_contadores_publicos(Request $request)
     {
        // Autor: Sandro Alan Gomez Aceituno
        // Modificación: 02 de Abril de 2024
        // Descripción: Optiene el capital contable del tramite inmediato interior.

        $vstatus=200;
        $vrespuesta=[
            'codigo'    => 0,
            'icono'     => 'warning',
            'mensaje'   => 'No se encontraron datos que mostrar'
        ];

        try {
            switch ($request->input('method')) {
                case 'show':
                    $filtro=$request->all();
                    $filtro['id_registro_tmp']=Auth::User()->id_registro;
                    $_DATA_MDL_Personal=T_Tramite_Contador::queryToDB($filtro)->first();                    
                  break;
                case 'get':

                    $_DATA_MDL_Personal=D_Personal::queryToDB_CPC([])->get();
                  break;
                default:
                    $vrespuesta['mensaje']='Metodo de petición, no definido.';
                  break;
            }
            
            if ( isset($_DATA_MDL_Personal) ) {
                $vrespuesta=[
                    'codigo'    => 1,
                    'icono'     => 'success',
                    'mensaje'   => 'Exito',
                    'data'      => $_DATA_MDL_Personal
                ];
            }
        }
        catch (Exception $e) {
            DB::rollback();
            $vrespuesta=[
                'codigo'=> -1,
                'icono'=> 'error',
                'mensaje'=> $vexception->getMessage()
            ];
        }
        return response()->json($vrespuesta, $vstatus);
     }

    public function store_contadores_publicos(Request $request)
     {
        // Autor: Sandro Alan Gomez Aceituno
        // Modificación: 02 de Abril de 2024
        // Descripción: Guarda el contador público certificado en la tabla t_tramites_contadores.

        $vrespuestaHTTP=201;
        $vrespuesta=[
            'codigo'=> 0,
            'icono'=> 'warning',
            'mensaje'=> 'El registro no se ha podido registrar, intente de nuevo.'
        ];

        $validator=Validator::make($request->all(), [
            'id_contador' => 'required'
        ]);

        if ( $validator->fails() ) {
            return response()->json([
                'codigo'=>0,
                'icono'=>'warning',
                'mensaje'=> 'Agradecemos que complete todos los campos del formulario.'], 201);
        }

        try {
            DB::beginTransaction();
            $_Input_Request=$request->all();
            $_Input_Request['id_registro_tmp']=Auth::User()->id_registro;
            $_Input_Request['id_d_personal']=$request['id_contador'];

            $_MDL_Tramite_Contador=new T_Tramite_Contador;
            $vrespuesta['mensaje']='Los datos han sido <b>REGISTRADOS</b> exitosamente.';

            if ( $_Input_Request['id_registro_tmp'] != 0 ) {
                $_MDL_Tramite_Contador=T_Tramite_Contador::where('id_registro_tmp', Auth::User()->id_registro)->first();

                $vrespuesta['mensaje']='Los datos han sido <b>ACTUALIZADOS</b> exitosamente.';
            }
            
            $_MDL_Tramite_Contador->fill($_Input_Request)->save();

            $vrespuesta['codigo']=1;
            $vrespuesta['icono']='success';
            // $vrespuesta['mensaje']='El contador ha sido agrego satisfactoriamente.';
            DB::commit();
        }
        catch (Exception $e) {
            $vrespuestaHTTP = 500;
            $vrespuesta=[
                'codigo'=> -1,
                'icono'=> 'error',
                'mensaje'=> 'Hubo un error al registrar el RTEC. Intenta nuevamente. '. $vexception->getMessage()
            ];
            DB::rollback();
        }

        return response()->json($vrespuesta, $vrespuestaHTTP);
     }

    public function api_capital_contable(Request $request)
     {
        // Autor: Sandro Alan Gomez Aceituno
        // Modificación: 02 de Abril de 2024
        // Descripción: Optiene el capital contable del tramite inmediato interior.

        $vstatus=200;
        $vrespuesta=[
            'codigo'    => 0,
            'icono'     => 'warning',
            'mensaje'   => 'No se encontraron datos que mostrar'
        ];

        try {
            $_DATA_MDL_Tramite_Capital_Contable=T_Tramite_Capital_Contable::where('id_registro', Auth::User()->id_registro)->first();
            
            if ( isset($_DATA_MDL_Tramite_Capital_Contable) ) {
                $vrespuesta=[
                    'codigo'    => 1,
                    'icono'     => 'success',
                    'mensaje'   => 'Exito',
                    'data'      => $_DATA_MDL_Tramite_Capital_Contable
                ];
            }
        }
        catch (Exception $e) {
            DB::rollback();
            $vrespuesta=[
                'codigo'=> -1,
                'icono'=> 'error',
                'mensaje'=> $vexception->getMessage()
            ];
        }

        return response()->json($vrespuesta, $vstatus);
     }

    public function api_estados_financieros(Request $request)
     {
        // Autor: Sandro Alan Gomez Aceituno
        // Modificación: 02 de Abril de 2024
        // Descripción: Optiene los datos de los estados financieros del ultimo tramite.

        $vstatus=200;
        $vrespuesta=[
            'codigo'    => 0,
            'icono'     => 'warning',
            'mensaje'   => 'No se encontraron datos que mostrar'
        ];

        try {
            $_DATA_MDL_Tramite_Estado_Financiero=T_Tramite_Estado_Financiero::where('id_registro', Auth::User()->id_registro)->first();

            if ( isset($_DATA_MDL_Tramite_Estado_Financiero) ) {
                $array_response['id']=$_DATA_MDL_Tramite_Estado_Financiero->id;
                $array_response['utilidad_perdida']=json_decode($_DATA_MDL_Tramite_Estado_Financiero->utilidad_perdida);
                $array_response['balance_gral']=json_decode($_DATA_MDL_Tramite_Estado_Financiero->balance_gral);
                $array_response['razon_liquidez']=json_decode($_DATA_MDL_Tramite_Estado_Financiero->razon_liquidez);
                $array_response['razon_endeudamiento']=json_decode($_DATA_MDL_Tramite_Estado_Financiero->razon_endeudamiento);
                $array_response['razon_rentabilidad']=json_decode($_DATA_MDL_Tramite_Estado_Financiero->razon_rentabilidad);
                $array_response['capital_neto']=json_decode($_DATA_MDL_Tramite_Estado_Financiero->capital_neto);

                $vrespuesta=[
                    'codigo'    => 1,
                    'icono'     => 'success',
                    'mensaje'   => 'Exito',
                    'data'      => $array_response
                ];
            }
        }
        catch (Exception $e) {
            DB::rollback();
            $vrespuesta=[
                'codigo'=> -1,
                'icono'=> 'error',
                'mensaje'=> $vexception->getMessage()
            ];
        }

        return response()->json($vrespuesta, $vstatus);
     }

    public function store_capital_contable(Request $request)
     {
        // Autor: Sandro Alan Gomez Aceituno
        // Modificación: 02 de Abril de 2024
        // Descripción: Guardas los registros del capital contable.

        $vrespuestaHTTP=201;
        $vrespuesta=[
            'codigo'=> 0,
            'icono'=> 'warning',
            'mensaje'=> 'El registro no se ha podido registrar, intente de nuevo.'
        ];

        $validator=Validator::make($request->all(), [
            'id_capital_contable' => 'required',
            'capital' => 'required',
            'fecha_elaboracion' => 'required',
            'fecha_declaracion' => 'required',
            'observaciones' => 'required'
        ]);

        if ( $validator->fails() ) {
            return response()->json([
                'codigo'=>0,
                'icono'=>'warning',
                'mensaje'=> 'Agradecemos que complete todos los campos del formulario.'], 201);
        }

        try {
            DB::beginTransaction();
            $_Input_Request=$request->all();
            $_Input_Request['id_registro']=Auth::User()->id_registro;

            $_MDL_Tramite_Capital_Contable=new T_Tramite_Capital_Contable;
            $vrespuesta['mensaje']='Los datos han sido <b>REGISTRADOS</b> exitosamente.';
            if ( $_Input_Request['id_capital_contable'] != 0 ) {
                $_MDL_Tramite_Capital_Contable=T_Tramite_Capital_Contable::find((int)$_Input_Request['id_capital_contable']);
                $vrespuesta['mensaje']='Los datos han sido <b>ACTUALIZADOS</b> exitosamente.';
            }
            
            $_MDL_Tramite_Capital_Contable->fill($_Input_Request)->save();

            $vrespuesta['codigo']=1;
            $vrespuesta['icono']='success';
            DB::commit();
        }
        catch (Exception $e) {
            $vrespuestaHTTP = 500;
            $vrespuesta=[
                'codigo'=> -1,
                'icono'=> 'error',
                'mensaje'=> 'Hubo un error al registrar el RTEC. Intenta nuevamente. '. $vexception->getMessage()
            ];
            DB::rollback();
        }

        return response()->json($vrespuesta, $vrespuestaHTTP);
     }


    public function store_estados_financieros(Request $request)
     {
        // Autor: Sandro Alan Gomez Aceituno
        // Modificación: 02 de Abril de 2024
        // Descripción: Guardas los registros del capital contable.

        $vrespuestaHTTP=201;
        $vrespuesta=[
            'codigo'=> 0,
            'icono'=> 'warning',
            'mensaje'=> 'El registro no se ha podido registrar, intente de nuevo.'
        ];

        $validator=Validator::make($request->all(), [
            'id_estado_financiero' => 'required',
            'utilidad_perdida' => 'required',
            'balance_gral' => 'required',
            'razon_liquidez' => 'required',
            'razon_endeudamiento' => 'required',
            'razon_rentabilidad' => 'required',
            'capital_neto' => 'required'
        ]);

        if ( $validator->fails() ) {
            return response()->json([
                'codigo'=>0,
                'icono'=>'warning',
                'mensaje'=> 'Agradecemos que complete todos los campos del formulario.'], 201);
        }

        try {
            DB::beginTransaction();
            $_Input_Request=$request->all();

            $_array_periodo=['actual'=>date('Y'), 'anterior'=> 0];
            $_array_utilidad_perdida=['actual'=>$request->utilidad_perdida, 'anterior'=> 0];
            $_array_balance_gral=['actual'=>$request->balance_gral, 'anterior'=> 0];
            $_array_razon_liquidez=['actual'=>$request->razon_liquidez, 'anterior'=> 0];
            $_array_razon_endeudamiento=['actual'=>$request->razon_endeudamiento, 'anterior'=> 0];
            $_array_razon_rentabilidad=['actual'=>$request->razon_rentabilidad, 'anterior'=> 0];
            $_array_capital_neto=['actual'=>$request->capital_neto, 'anterior'=> 0];

            $_Input_Request['id_registro']=Auth::User()->id_registro;
            $_Input_Request['periodo']=json_encode($_array_periodo);
            $_Input_Request['utilidad_perdida']=json_encode($_array_utilidad_perdida);
            $_Input_Request['balance_gral']=json_encode($_array_balance_gral);
            $_Input_Request['razon_liquidez']=json_encode($_array_razon_liquidez);
            $_Input_Request['razon_endeudamiento']=json_encode($_array_razon_endeudamiento);
            $_Input_Request['razon_rentabilidad']=json_encode($_array_razon_rentabilidad);
            $_Input_Request['capital_neto']=json_encode($_array_capital_neto);

            $_MDL_Tramite_Estado_Financiero=new T_Tramite_Estado_Financiero;
            $vrespuesta['mensaje']='Los datos han sido <b>REGISTRADOS</b> exitosamente.';
            if ( $_Input_Request['id_estado_financiero'] != 0 ) {
                $_MDL_Tramite_Estado_Financiero=T_Tramite_Estado_Financiero::find((int)$_Input_Request['id_estado_financiero']);
                $vrespuesta['mensaje']='Los datos han sido <b>ACTUALIZADOS</b> exitosamente.';
            }

            $_MDL_Tramite_Estado_Financiero->fill($_Input_Request)->save();

            $vrespuesta['codigo']=1;
            $vrespuesta['icono']='success';
            DB::commit();
        }
        catch (Exception $e) {
            $vrespuestaHTTP = 500;
            $vrespuesta=[
                'codigo'=> -1,
                'icono'=> 'error',
                'mensaje'=> 'Hubo un error al registrar el RTEC. Intenta nuevamente. '. $vexception->getMessage()
            ];
            DB::rollback();
        }

        return response()->json($vrespuesta, $vrespuestaHTTP);
     }
 }