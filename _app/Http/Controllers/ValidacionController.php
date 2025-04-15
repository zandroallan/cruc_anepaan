<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Models\Backend\T_Tramite;

class ValidacionController extends Controller
{
 

    public function validar()
    {              
        return view('validar.index');
    } 

    public function getData(Request $vrequest)
     {
        $vHTTPCode=200;
        $vresponse=['codigo'=>1, 'mensaje'=>'Exito', 'icono'=>'success'];

        try {
                $varray=array();
                $vfilter=array();
                if(isset($vrequest->folio)) $vfilter['folio'] = $vrequest->folio;
                if(isset($vrequest->rfc))   $vfilter['rfc'] = $vrequest->rfc;             

                $tramite = T_Tramite::datos_certificado_v($vfilter)->first();
                $varray['tramite'] = $tramite;                

                $vresponse['respuesta']= $varray;
        }
        catch (Exception $vexception) {
            $vHTTPCode=500;
            $vresponse=[
                'codigo'=>-1,
                'mensaje'=>'Error en el servidor! Comuniquese con su administrador '. $vexception->getMessage(),
                'icono'=>'danger'
            ];
        }

        return response()->json($vresponse, $vHTTPCode);                
     } 

    /************************************************/


    public function index()
    {       
       
        return view('validaciones.index');
    } 


    public function getValida($folio)
    {        
       // $id =  Crypt::decrypt($id);
        $tramite = T_Tramite::datos_validacion($folio)->first();

        $t_tramite = T_Tramite::datos_validacion_movil($tramite->id);

        return view('validaciones.constancia', ['tramite'=>$tramite, 'datos' => $t_tramite]);
    }      

    public function buscar(Request $request)
    {
        $vstatus=200;
        $vrespuesta=array();
        try {
            $vfiltro=array();
            $vfiltro['folio'] = $request->input('cadena');
            $vrespuesta = T_Tramite::buscador_tramites_terminados($vfiltro)->get();
        }
        catch(Exception $vexception ){
            $vstatus=500;
            $vrespuesta['message']=$vexception->getMessage();
        }
        return response()->json($vrespuesta, $vstatus);
    }

    public function qr($id)
    {        
        $tramite = T_Tramite::find($id);
        return view('validaciones.qr', ['id'=>$id, 'folio'=>$tramite->folio]);
    } 
}
