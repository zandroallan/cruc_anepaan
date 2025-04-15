<?php

namespace App\Http\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class T_Tramite_Dato_Legal extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 't_tramites_datos_legales';
    protected $fillable = [
        'id', 
        'id_tramite',
        'id_registro_tmp', 
        'imss',
        'boleta_pago', 
        'fecha_pago', 
        'fecha_inicio', 
        'fecha_inscripcion', 
        'actividad',
        'rec',
        'num_constancia',
        'num_control',
        'vigencia_de',
        'vigencia_al',
    ];

    protected $hidden = [
        //'id',
    ];

    public static function general($data=[])
    {
        $result = T_Tramite_Dato_Legal::select('*');
        if(array_key_exists('id_tramite', $data)) {
            $filtro= $data["id_tramite"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('id_tramite','=',$filtro);
            });
        }
        if(array_key_exists('id_registro_tmp', $data)) {
            $filtro= $data["id_registro_tmp"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('id_registro_tmp', '=', $filtro);
            });
        } 
        if(array_key_exists('id', $data)) {
            $filtro= $data["id"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('id','!=',$filtro);
            });
        }
        $result= $result->orderBy('id','DESC');
        return $result;
    }

    public static function edit($id_registro_tmp)
    {
        return T_Tramite_Dato_Legal::select('*')
                ->where('id_registro_tmp', $id_registro_tmp)
                ->orderBy('id', 'desc')
                ->first();
    }    
}