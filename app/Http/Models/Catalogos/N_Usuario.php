<?php

namespace App\Http\Models\Catalogos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class N_Usuario extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'n_usuarios';
    protected $fillable = [
        'id', 'id_tipo_notificacion', 'id_usuario', 'id_tramite', 'descripcion', 'visto', 'acepto_condiciones', 'fecha_acuse','id_c_notificacion', 'fecha_limite'
    ];

    protected $hidden = [
        //'id',
    ];
	
    public static function notificacionSinAcusarCron()
     {
        /**
         * Sandro Alan Gómez Aceituno
         * Consulta las los tramites que llevan mas de 30 dias notificados
         * */
        $result = N_Usuario::select(
            'n_usuarios.*',
            't_tramites.folio',
            't_tramites.id_tipo_tramite',
            't_registro.email',
            't_registro.razon_social_o_nombre',
            DB::raw('DATEDIFF(DATE(n_usuarios.created_at), NOW()) as diasNotificado')
        );
        $result=$result->join('t_tramites', 'n_usuarios.id_tramite', '=', 't_tramites.id');
        $result=$result->join('t_registro', 't_tramites.id_cs', '=', 't_registro.id');
        $result=$result->where('t_tramites.id_status', 4);
        $result=$result->where('n_usuarios.id_c_notificacion', 1);
        // $result=$result->where(DB::raw('year(t_tramites.fecha_inicio)'), date('Y'));
        $result=$result->where(DB::raw('DATEDIFF(DATE(n_usuarios.created_at), NOW())'), '<', -30);
        $result=$result->whereNull('t_tramites.fecha_solventacion');
        $result=$result->whereNull('n_usuarios.fecha_acuse');
        $result=$result->orderBy('n_usuarios.id', 'DESC');
        return $result;
     }

	public static function notificacionPorExpirarCron()
     {
        /**
         * Sandro Alan Gómez Aceituno
         * Consulta los tramites que estan por a unos dias por expirar
         * */
        $result = N_Usuario::select(
            'n_usuarios.*',
            't_tramites.folio',
            't_tramites.id_tipo_tramite',
            't_registro.email',
            't_registro.razon_social_o_nombre',
            DB::raw('DATEDIFF(n_usuarios.fecha_limite, NOW()) as diasPendiente')
        );
        $result=$result->join('t_tramites', 'n_usuarios.id_tramite', '=', 't_tramites.id');
        $result=$result->join('t_registro', 't_tramites.id_cs', '=', 't_registro.id');
        $result=$result->where('t_tramites.id_status', 4);
        $result=$result->where('n_usuarios.id_c_notificacion', 1);
        // $result=$result->where(DB::raw('year(t_tramites.fecha_inicio)'), date('Y'));
        $result=$result->where(DB::raw('DATEDIFF( n_usuarios.fecha_limite, NOW())'), 3);
        $result=$result->whereNull('t_tramites.fecha_solventacion');
        $result=$result->whereNotNull('n_usuarios.fecha_acuse');
        $result=$result->orderBy('n_usuarios.id', 'DESC');
        return $result;
     }

    public static function notificacionesExpiradasCron()
     {
        /**
         * Sandro Alan Gómez Aceituno
         * Consulta los tramites que han sido expirados a su fecha limite de solventación.
         * 04 de Abril del 2022
         * */

        $result = N_Usuario::select(
            'n_usuarios.*',
            't_tramites.folio',
            't_tramites.id_tipo_tramite',
            't_registro.email',
            't_registro.razon_social_o_nombre'
        );
        $result=$result->join('t_tramites', 'n_usuarios.id_tramite', '=', 't_tramites.id');
        $result=$result->join('t_registro', 't_tramites.id_cs', '=', 't_registro.id');
        $result=$result->where('t_tramites.id_status', 4);
        $result=$result->where('n_usuarios.id_c_notificacion', 1);
        //$result=$result->where(DB::raw('year(t_tramites.fecha_inicio)'), 2021);
        $result=$result->where('n_usuarios.fecha_limite', '<', date('Y-m-d'));
        $result=$result->whereNull('t_tramites.fecha_solventacion');
        $result=$result->where('n_usuarios.visto', 1);
        $result=$result->whereNotNull('n_usuarios.fecha_acuse');
        $result=$result->orderBy('n_usuarios.id', 'DESC');
        return $result;
     }
	
    public static function general($data=[]){
        $result = N_Usuario::select('n_usuarios.id', 'n_usuarios.id_c_notificacion' , 'n_usuarios.id_tipo_notificacion', 'n_usuarios.id_usuario','n_usuarios.id_tramite', 'n_usuarios.descripcion', 'u.name as nombre', 'n_usuarios.visto', 'n_usuarios.created_at as fecha', 'n_usuarios.acepto_condiciones', 't.folio','n_usuarios.fecha_acuse', 'n_usuarios.fecha_limite');
        $result= $result->leftJoin('users as u', 'u.id', '=', 'n_usuarios.id_usuario');
        $result= $result->leftJoin('t_tramites as t', 't.id', '=', 'n_usuarios.id_tramite');

        
        if(array_key_exists('id_usuario', $data)){
            $filtro= $data["id_usuario"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('n_usuarios.id_usuario','=',$filtro);
                });
        }

        if(array_key_exists('id_registro', $data)){
            $filtro= $data["id_registro"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('t.id_cs','=',$filtro);
                });
        }  
                
        if(array_key_exists('id_tipo_notificacion', $data)){
            $filtro= $data["id_tipo_notificacion"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('n_usuarios.id_tipo_notificacion','=',$filtro);
                });
        }   
        
        if(array_key_exists('acepto_condiciones', $data)){
            $filtro= $data["acepto_condiciones"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('n_usuarios.acepto_condiciones','=',$filtro);
                });
        }         

        if(array_key_exists('id_tramite', $data)){
            $filtro= $data["id_tramite"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('n_usuarios.id_tramite','=',$filtro);
                });
        }  

        if(array_key_exists('id', $data)){
            $filtro= $data["id"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('n_usuarios.id','!=',$filtro);
                });
        }   
        
         if(array_key_exists('id_c_notificacion', $data)){
            $filtro= $data["id_c_notificacion"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('n_usuarios.id_c_notificacion','=',$filtro);
                });
        } 

        $result= $result->orderBy('n_usuarios.id','DESC');
        return $result;
    }

    public static function general2($data=[]){
        $result = N_Usuario::select(
                                    'n_usuarios.id', 
                                    'n_usuarios.id_tramite', 
                                    'n_usuarios.fecha_acuse', 
                                    'n_usuarios.fecha_limite',
                                    't.folio');

        $result= $result->leftJoin('t_tramites as t', 't.id', '=', 'n_usuarios.id_tramite');

        if(array_key_exists('acepto_condiciones', $data)){
            $filtro= $data["acepto_condiciones"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('n_usuarios.acepto_condiciones','=',$filtro);
                });
        }         

        if(array_key_exists('id_tramite', $data)){
            $filtro= $data["id_tramite"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('n_usuarios.id_tramite','=',$filtro);
                });
        }  

        if(array_key_exists('id', $data)){
            $filtro= $data["id"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('n_usuarios.id','!=',$filtro);
                });
        }   
        
         if(array_key_exists('id_c_notificacion', $data)){
            $filtro= $data["id_c_notificacion"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('n_usuarios.id_c_notificacion','=',$filtro)->orWhere('n_usuarios.id_c_notificacion','=',6);
                });
        } 

        $result= $result->orderBy('n_usuarios.id','DESC');
        return $result;
    }          

}
