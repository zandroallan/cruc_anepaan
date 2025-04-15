<?php
namespace App\Http\Models\Catalogos;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class C_Colegio extends Model
 {
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'c_colegios';
    protected $fillable = [
        'id', 
        'id_tipo_colegio', 
        'nombre'
    ];

    protected $hidden = [
        //'id',
    ];

    public static function lists($data=[])
     {
        $result= C_Colegio::select('id','nombre');
        if(array_key_exists('id_tipo_colegio', $data)) {
            $filtro= $data["id_tipo_colegio"];
            if($filtro==100) {
                $result= $result->where( function($sql) use ($filtro) {
                    $sql->where('id_tipo_colegio','!=',$filtro);
                });
            }
            else {
                $result= $result->where( function($sql) use ($filtro) {
                    $sql->where('id_tipo_colegio','=',$filtro);
                });
            }
        }
        $result=$result->orderBy('nombre','ASC')->pluck('nombre','id','deleted_at')->prepend('Seleccionar', 0)->all();
        return $result;
     }

    public static function lstColegios()
     {
        $result= C_Colegio::select('c_colegios.id','c_colegios.nombre', 'tc.nombre as tipo_colegio');    
        $result= $result->leftJoin('c_tipos_colegio as tc', 'c_colegios.id_tipo_colegio', '=', 'tc.id');
        $result= $result->orderBy('c_colegios.nombre', 'ASC');
        return $result;
     }
 }
