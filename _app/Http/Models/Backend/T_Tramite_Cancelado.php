<?php

namespace App\Http\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class T_Tramite_Cancelado extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 't_tramites_cancelados';
    protected $fillable = [
        'id', 
        'id_tramite', 
        'id_usuario_solicito',
        'id_autorizo', 
        'id_area', 
        'motivo',
        'motivo_autorizo',
        'cancelado',
        'fecha',
        'path',
        'archivo',
        'extencion',
        'acuse'
    ];

    protected $hidden = [
        //'id',
    ];
   
}