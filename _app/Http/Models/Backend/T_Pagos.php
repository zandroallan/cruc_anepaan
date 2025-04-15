<?php

namespace App\Http\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Auth;
class T_Pagos extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 't_tramites_certificados';
    protected $fillable = [
        'id',  
        'id_tramite', 
        'folio_hacienda',
        'fecha_pago',
        'forma_valorada', 
        'fecha', 
        'coordinador',
        'observaciones',
        'utilizado'
    ];

    protected $hidden = [
        //'id',
    ]; 

     
    public static function busca_formatos($data=[]){
        $result = T_Pagos::select('*');         
        
        if(array_key_exists('folio_pago', $data)){
            $filtro= $data["folio_pago"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('folio_hacienda','=',$filtro);
                });
        }

        //$result= $result->withTrashed();
        $result= $result->orderBy('id','DESC');
        return $result;
    }  
}
