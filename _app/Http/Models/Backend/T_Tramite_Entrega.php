<?php

namespace App\Http\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class T_Tramite_Entrega extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 't_tramites_entregas';
    protected $fillable = [
        'id',
        'razon_social_o_nombre',
        'rfc',
        'folio',
        'representante_legal_2019',
        'mesa',
        'hora',
        'fecha',
        'enviado'
    ];

    protected $hidden = [
        //'id',
    ];

    public static function tramitesEntregas()
    {
        $result=T_Tramite_Entrega::select(
            't_tramites_entregas.id',
            't_tramites.id as id_tramite',
            't_registro.id as id_registro',
            't_tramites_entregas.folio',
            't_tramites_entregas.razon_social_o_nombre',
            't_registro.email',
            't_tramites_entregas.mesa',
            't_tramites_entregas.fecha',
            't_tramites_entregas.hora',
            't_tramites_entregas.enviado'
        );
        $result=$result->join('t_tramites', 't_tramites.folio', '=', 't_tramites_entregas.folio');
        $result=$result->join('t_registro', 't_tramites.id_cs', '=', 't_registro.id');
        $result=$result->where('t_tramites_entregas.enviado', 0);
        $result=$result->whereNull('t_tramites.deleted_at');
        $result=$result->orderBy('t_tramites_entregas.folio', 'ASC');
        $result=$result->limit(50);
        return $result;

    }    
}