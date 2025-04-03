<?php

namespace App\Http\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class T_Tramite_Estado_Financiero extends Model
{
    use SoftDeletes;
    protected $dates    = ['deleted_at'];
    protected $table    = 't_tramites_estado_financiero';
    protected $fillable = [
        'id',
        'id_registro',
        'id_tramite',
        'periodo',
        'utilidad_perdida',
        'balance_gral',
        'razon_liquidez',
        'razon_endeudamiento',
        'razon_rentabilidad',
        'capital_neto',
    ];

    protected $hidden = [
        //'id',
    ];

    public static function general($data = [])
    {
        $result = T_Tramite_Estado_Financiero::select('*');

        if (array_key_exists('id_tramite', $data)) {
            $filtro = $data["id_tramite"];
            $result = $result->where(function ($sql) use ($filtro) {
                $sql->where('id_tramite', $filtro);
            });
        }
        if (array_key_exists('id', $data)) {
            $filtro = $data["id"];
            $result = $result->where(function ($sql) use ($filtro) {
                $sql->where('id', '!=', $filtro);
            });
        }
        $result = $result->orderBy('id', 'DESC');
        return $result;
    }

    public static function historial($id_cs)
    {
        $result = T_Tramite_Estado_Financiero::select('t_tramites_estado_financiero.*', 't.id_cs');
        $result = $result->leftJoin('t_tramites as t', 't.id', '=', 't_tramites_estado_financiero.id_tramite');

        $result = $result->where('t.id_cs', $id_cs);
        $result = $result->orderBy('t_tramites_estado_financiero.id', 'DESC');
        return $result;
    }

    public static function edit($id_tramite)
    {
        $result = T_Tramite_Estado_Financiero::select('*')->where('id_tramite', $id_tramite)->orderBy('id', 'desc')->first();
        return $result;
    }
}
