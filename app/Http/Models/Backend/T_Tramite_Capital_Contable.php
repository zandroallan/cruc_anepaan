<?php

namespace App\Http\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class T_Tramite_Capital_Contable extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 't_tramites_capital_contable';
    protected $fillable = [
        'id', 
        'id_registro',
        'id_tramite', 
        'capital',
        'fecha_declaracion', 
        'observaciones', 
        'fecha_elaboracion',
    ];

    protected $hidden = [
        //'id',
    ];

    public static function general($data=[])
     {
        $result = T_Tramite_Capital_Contable::select('*');

        if(array_key_exists('id_tramite', $data)){
            $filtro= $data["id_tramite"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('id_tramite','=',$filtro);
            });
        } 
    
        if(array_key_exists('id', $data)){
            $filtro= $data["id"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('id','!=',$filtro);
            });
        }
        $result= $result->orderBy('id','DESC');
        return $result;
     }

    public static function edit($id_tramite)
     {
        $result = T_Tramite_Capital_Contable::select('*')->where('id_tramite', $id_tramite)->orderBy('id', 'desc')->first();
        return $result;
     }    
}