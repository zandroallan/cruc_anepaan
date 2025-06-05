<?php

namespace App\Http\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class D_Domicilio extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'd_domicilios';
    protected $fillable = [
        'id', 
        'id_tipo_domicilio', 
        'id_municipio', 
        'colegios',
        'ciudad', 
        'codigo_postal', 
        'calle', 
        'num_exterior', 
        'num_interior',
        'colonia',
        'entre_calle',
        'y_calle',
        'referencias'
    ];

    protected $hidden = [
        //'id',
    ];

    public static function queryToDB($data = [])
     {
        $query = D_Domicilio::select('d_domicilios.*');

        if(array_key_exists('id_domicilio', $data)){
            $filtro= $data["id_domicilio"];
            $query= $query->where( function($sql) use ($filtro){
                $sql->where('d_domicilios.id', $filtro);
            });
        }

        return $query->orderBy('d_domicilios.id', 'DESC');
     }

}