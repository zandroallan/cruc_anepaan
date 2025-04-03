<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Backend\T_Registro;
use App\Http\Models\Backend\T_Tramite_Capital_Contable;
use App\Http\Models\Backend\T_Tramite_Estado_Financiero;



// use App\Http\Requests\Backend\AgregarEspecialidadRTEC;
// use App\Http\Models\Backend\T_Registro;
// use App\Http\Requests\Backend\T_Tramite_Tecnica_Representante_Tecnico;
// use App\Http\Models\Backend\T_Tramite_Rep_Tecnico;
// use App\Http\Models\Catalogos\C_Especialidad;
// use App\Http\Models\Backend\D_Personal;
// use App\Http\Models\Backend\D_Domicilio;
// use App\Http\Models\Catalogos\C_Colegio;
// use App\Http\Models\Catalogos\C_Tipo_Colegio;
// use App\Http\Classes\FormatDate;
// use App\Http\Classes\Validations;
// use Carbon\Carbon;
use Auth;
use DB;

class FinancieraController extends Controller
 {
    public function __construct() 
     {
        $this->middleware('auth');     
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
            $_DATA_MDL_Registro=T_Registro::find(Auth::User()->id_registro);
            if ( isset($_DATA_MDL_Registro->id_ultimo_tramite) ) {
                $_DATA_MDL_Tramite_Capital_Contable=T_Tramite_Capital_Contable::where('id_tramite', $_DATA_MDL_Registro->id_ultimo_tramite)->first();

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
            $_DATA_MDL_Registro=T_Registro::find(Auth::User()->id_registro);
            if ( isset($_DATA_MDL_Registro->id_ultimo_tramite) ) {
                $_DATA_MDL_Tramite_Estado_Financiero=T_Tramite_Estado_Financiero::where('id_tramite', $_DATA_MDL_Registro->id_ultimo_tramite)->first();

                $vrespuesta=[
                    'codigo'    => 1,
                    'icono'     => 'success',
                    'mensaje'   => 'Exito',
                    'data'      => $_DATA_MDL_Tramite_Estado_Financiero
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

        $vcodigoRespuesta = 0;
        $vrespuestaHTTP   = 201;
        $vrutaRedireccion = '';
        $msg              = 'No se pudido mandar la solventacion';

        try {
            // DB::beginTransaction();


            $id_tramite = $request->input('hdIdTramiteCapital');
            $tramite=T_Tramite::find($id_tramite);

            $array= [];
            $array['id_cs']= $tramite->id_cs;
            $array['id_tramite']= $id_tramite;

            $tramite_anterior=T_Tramite::tramite_anterior($array)->first();
            if(isset($tramite_anterior->id)) {
                $datos_capital = T_Tramite_Capital_Contable::edit($tramite_anterior->id);  

                //se procede a guardar el dato    
                $status= 1; $code= 201;
                $p_capital['id_tramite']= $id_tramite; 
                $p_capital['capital']= $datos_capital->capital;
                $p_capital['fecha_declaracion']= $datos_capital->fecha_declaracion;
                $p_capital['fecha_elaboracion']= $datos_capital->fecha_elaboracion;
                $p_capital['observaciones']= $datos_capital->observaciones;

                $t_capital= new T_Tramite_Capital_Contable;
               
                        DB::beginTransaction();                
                            $t_capital->fill($p_capital)->save();
                        DB::commit();                
                                  
                        $msg= "La información fue recuperada satisfactoriamente";                    
                        $route_redirect= "";

                        $data= $t_capital;
            }

            // DB::commit();
        }
        catch (Exception $e) {
            $vrespuestaHTTP = 500;
            DB::rollback();
        }

        return response()->json(
            [
                'code'            => $vcodigoRespuesta,
                'msg'             => $msg,
                'rutaRedireccion' => $vrutaRedireccion
            ], $vrespuestaHTTP);
     }
 }