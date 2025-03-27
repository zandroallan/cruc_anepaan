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
        'ciudad', 
        'codigo_postal', 
        'calle', 
        'num_exterior', 
        'num_interior',
        'colonia',
        'referencias'
    ];

    protected $hidden = [
        //'id',
    ];

 

}