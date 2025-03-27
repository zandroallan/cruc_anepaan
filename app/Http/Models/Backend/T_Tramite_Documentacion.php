<?php

namespace App\Http\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class T_Tramite_Documentacion extends Model
{
    use SoftDeletes;
    protected $dates    = ['deleted_at'];
    protected $table    = 't_tramites_documentacion';
    protected $fillable = [
        'id',
        'id_tramite_observacion',
        'id_registro_temp',
        'id_tramite',
        'id_documentacion',
        'path',
        'nombre',
        'desglose',
        'extension',
        'tamanio',
        'id_status',
        'id_usuario_subio',
        'deleted_at',
        'alias',

    ];

    protected $hidden = [
        //'id',
    ];

    # Begin new code 2024-SAGA
    public static function documentacion_tramite_requerida_tmp($id_tramite, $id_documento)
     {
        $result = T_Tramite_Documentacion::select(
            't_tramites_documentacion.*',
            't_tramites.id_status_area_legal',
            't_tramites.id_status_area_tecnica',
            't_tramites.id_status_area_financiera'
        );
        $result=$result->leftJoin('t_tramites', 't_tramites.id', '=', 't_tramites_documentacion.id_tramite');
        $result=$result->where('t_tramites_documentacion.id_tramite', $id_tramite);
        $result=$result->where('t_tramites_documentacion.id_documentacion', $id_documento);
        $result=$result->where('t_tramites_documentacion.id_status', 2);
        $result=$result->whereNull('t_tramites_documentacion.id_registro_temp')->withTrashed()->first();
        return $result;
     }

    public static function documentacion_tramite_requerida_opcional_tmp($id_tramite, $id_documento)
    {
        $result = T_Tramite_Documentacion::select(
            't_tramites_documentacion.*',
            't.id_status_area_legal',
            't.id_status_area_tecnica',
            't.id_status_area_financiera'
        );
        $result=$result->leftJoin('t_tramites as t', 't.id', '=', 't_tramites_documentacion.id_tramite');
        $result=$result->where('t_tramites_documentacion.id_tramite', $id_tramite);
        $result=$result->where('t_tramites_documentacion.id_documentacion', $id_documento);
        $result=$result->where('t_tramites_documentacion.id_status', 2);
        $result=$result->whereNull('t_tramites_documentacion.id_registro_temp')->withTrashed()->get();
        return $result;
    }
    # End code 2024-SAGA


    public static function general($data = [])
    {
        $result = T_Tramite_Documentacion::select(
            't_tramites_documentacion.id',
            't_tramites_documentacion.id_tramite_observacion',
            't_tramites_documentacion.nombre as archivo',
            'd.nombre as documento',
            'd.id as id_documento'
        );
        $result = $result->leftJoin('c_documentacion as d', 'd.id', '=', 't_tramites_documentacion.id_documentacion');

        if (array_key_exists('id_documento', $data)) {
            $filtro = $data["id_documento"];
            $result = $result->where(function ($sql) use ($filtro) {
                $sql->where('t_tramites_documentacion.id_documentacion', '=', $filtro);
            });
        }

        if (array_key_exists('id_tramite_observacion', $data)) {
            $filtro = $data["id_tramite_observacion"];
            $result = $result->where(function ($sql) use ($filtro) {
                $sql->where('t_tramites_documentacion.id_tramite_observacion', '=', $filtro);
            });
        }

        if (array_key_exists('id_registro_temp', $data)) {
            $filtro = $data["id_registro_temp"];
            $result = $result->where(function ($sql) use ($filtro) {
                $sql->where('t_tramites_documentacion.id_registro_temp', '=', $filtro);
            });
        }

        if (array_key_exists('id_tramite', $data)) {
            $filtro = $data["id_tramite"];
            $result = $result->where(function ($sql) use ($filtro) {
                $sql->where('t_tramites_documentacion.id_tramite', '=', $filtro);
            });
        }

        if (array_key_exists('id', $data)) {
            $filtro = $data["id"];
            $result = $result->where(function ($sql) use ($filtro) {
                $sql->where('t_tramites_documentacion.id', '!=', $filtro);
            });
        }
        
        if (array_key_exists('id_tramite_null', $data)) {
            $result = $result->whereNull('t_tramites_documentacion.id_tramite');
        }
        $result = $result->orderBy('t_tramites_documentacion.id', 'DESC');
        return $result;
    }

    public static function documentacion_adjunta($id_tramite)
    {
        $result           = T_Tramite_Documentacion::select('*')->where('id_tramite', $id_tramite)->orderBy('id_documentacion', 'asc')->get();
        $ar_doctos        = [];
        $array            = [];
        $array_legal      = [];
        $array_tecnica    = [];
        $array_financiera = [];

        foreach ($result as $value) {
            $documentacion = \App\Http\Models\Catalogos\C_Documentacion::find($value->id_documentacion);
            $arr           = ['id' => $value->id, 'id_documentacion' => $documentacion->id, 'id_area' => $documentacion->id_area, 'nombre' => $documentacion->nombre];
            if ($documentacion->id_area == 2) {array_push($array_legal, $arr);}
            if ($documentacion->id_area == 3) {array_push($array_financiera, $arr);}
            if ($documentacion->id_area == 4) {array_push($array_tecnica, $arr);}
        }

        $ar_doctos["2"] = $array_legal;
        $ar_doctos["3"] = $array_financiera;
        $ar_doctos["4"] = $array_tecnica;

        return $ar_doctos;
    }

    public static function documentacion_adjunta_tmp($id_registro)
    {
        $result           = T_Tramite_Documentacion::select('*')->where('id_registro_temp', $id_registro)->orderBy('id_documentacion', 'asc')->get();
        $ar_doctos        = [];
        $array            = [];
        $array_legal      = [];
        $array_tecnica    = [];
        $array_financiera = [];

        foreach ($result as $value) {
            $documentacion = \App\Http\Models\Catalogos\C_Documentacion::find($value->id_documentacion);
            $arr           = ['id' => $value->id, 'id_documentacion' => $documentacion->id, 'id_area' => $documentacion->id_area, 'nombre' => $documentacion->nombre];
            if ($documentacion->id_area == 2) {array_push($array_legal, $arr);}
            if ($documentacion->id_area == 3) {array_push($array_financiera, $arr);}
            if ($documentacion->id_area == 4) {array_push($array_tecnica, $arr);}
        }

        $ar_doctos["2"] = $array_legal;
        $ar_doctos["3"] = $array_financiera;
        $ar_doctos["4"] = $array_tecnica;

        return $ar_doctos;
    }

    public static function documentacion_temporal_array($id_registro)
    {
        $result = T_Tramite_Documentacion::select('id_documentacion')->where('id_registro_temp', $id_registro)->whereNull('id_tramite')->orderBy('id_documentacion', 'asc')->get();
        $array  = [];
        foreach ($result as $value) {
            array_push($array, $value->id_documentacion);
        }
        return $array;
    }

    public static function documentacion_temporal($id_registro)
    {
        $result = T_Tramite_Documentacion::select('*')->where('id_registro_temp', $id_registro)->whereNull('id_tramite')->orderBy('id_documentacion', 'asc')->get();
    }

    public static function documentacion_requerida_tmp($id_registro, $id_documento)
    {

        $result = T_Tramite_Documentacion::select('*')->where('id_registro_temp', $id_registro)->where('id_documentacion', $id_documento)->whereNull('id_tramite')->first();

        return $result;
    }

    public static function documentacion_requerida_opcional_tmp($id_registro, $id_documento)
    {
        $result = T_Tramite_Documentacion::select('*')->where('id_registro_temp', $id_registro)->where('id_documentacion', $id_documento)->whereNull('id_tramite')->get();

        return $result;
    }

    //Nuevo
    public static function documentacion_descarga_tmp($id_tramite, $id_documento)
    {
        $result = T_Tramite_Documentacion::select('*')->where('id_tramite', $id_tramite)->where('id_documentacion', $id_documento)->whereNull('id_tramite')->first();
        return $result;
    }

    public static function documentacion_descarga_opcional_tmp($id_tramite, $id_documento)
    {
        $result = T_Tramite_Documentacion::select('*')->where('id_tramite', $id_tramite)->where('id_documentacion', $id_documento)->whereNull('id_tramite')->get();
        return $result;
    }
}
