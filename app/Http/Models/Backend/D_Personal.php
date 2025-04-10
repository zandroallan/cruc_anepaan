<?php

namespace App\Http\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class D_Personal extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'd_personales';
    protected $fillable = [
        'id', 
        'id_d_domicilio', 
        'nombre', 
        'ap_paterno', 
        'ap_materno', 
        'curp', 
        'rfc', 
        'id_nacionalidad',
        'fecha_nacimiento',
        'sexo',
        'telefono',
        'correo_electronico',
        'id_tipo_identificacion',
        'numero_identificacion'
    ];

    protected $hidden = [
        //'id',
    ];

    public static function queryToDB_CPC($data = [])
     {
        $query = D_Personal::select('d_personales.*');

        if (!empty($data['curp'])) {
            $query->where('d_personales.curp', $data['curp']);
        }
        if (!empty($data['id_registro_tmp'])) {
            $query->where('d_personales.id_registro_tmp', $data['id_registro_tmp']);
        }

        $query->where('d_personales.colegios', 1);
        return $query->orderByDesc('d_personales.id');
     }

}