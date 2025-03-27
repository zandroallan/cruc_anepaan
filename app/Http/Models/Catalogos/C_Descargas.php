<?php

namespace App\Http\Models\Catalogos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class C_Descargas extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'c_descargas';
    protected $fillable = [
        'id', 'clave', 'nombre', 'tipo', 'activo'
    ];

    protected $hidden = [
        //'id',
    ];
 
    public static function lists($data=[]){
        $result= C_Descargas::select('*');
               
        $result= $result->where('activo','=', '1');
        $result= $result->orderBy('clave','ASC');
        return $result;
    }    

}