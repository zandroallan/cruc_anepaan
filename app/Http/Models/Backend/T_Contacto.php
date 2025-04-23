<?php

namespace App\Http\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class T_Contacto extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 't_contacto';
    protected $fillable = [
        'id', 
        'id_registro_temp',
        'id_tramite', 
        'nombre', 
        'ap_paterno', 
        'ap_materno', 
        'cargo', 
        'clave_atencion',
        'telefono'
    ];

    protected $hidden = [
        //'id',
    ];

    public static function busca_contacto($data=[]){
        $result = t_contacto::select(
            't_contacto.id',
            't_contacto.id_registro_temp',
            't_contacto.id_tramite',
            't_contacto.nombre',
            't_contacto.ap_paterno',
            't_contacto.ap_materno',
            't_contacto.cargo',
            't_contacto.clave_atencion',
            't_contacto.telefono as telefono_contacto'
        );         
        
        if(array_key_exists('id_registro_temp', $data)){
            $filtro= $data["id_registro_temp"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('id_registro_temp','=',$filtro);
                });
        }

        if(array_key_exists('id_tramite', $data)){
            $filtro= $data["id_tramite"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('id_tramite','=',$filtro);
                });
        }

        $result= $result->orderBy('id','DESC');
        return $result;
    } 
}
