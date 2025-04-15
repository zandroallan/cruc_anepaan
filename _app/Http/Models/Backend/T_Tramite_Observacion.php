<?php

namespace App\Http\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class T_Tramite_Observacion extends Model
{
    use SoftDeletes;
    protected $dates    = ['deleted_at'];
    protected $table    = 't_tramites_observaciones';
    protected $fillable = [
        'id',
        'id_tramite',
        'id_tramite_documentacion',
        'id_area',
        'id_documentacion',
        'id_usuario',
        'observacion',
        'id_status',
        'solventado',
    ];

    protected $hidden = [
        //'id',
    ];

    public static function observacionesAreas($idTramite)
    {
        $result = T_Tramite_Observacion::select(
            't_tramites_observaciones.*',
            'c_status.nombre as status',
            'c_status.color as status_color',
            'doc_padre.nombre as documento_padre',
            'c_documentacion.nombre as documento'
        );
        $result = $result->leftJoin('c_status', 't_tramites_observaciones.id_status', '=', 'c_status.id');
        $result = $result->leftJoin('c_documentacion', 't_tramites_observaciones.id_documentacion', '=', 'c_documentacion.id');
        $result = $result->leftJoin('c_documentacion as doc_padre', 'c_documentacion.id_padre', '=', 'doc_padre.id');
        $result = $result->where('t_tramites_observaciones.id_tramite', $idTramite)->get();

        $arrayObservaciones           = [];
        $arrayObservacionesLegal      = [];
        $arrayObservacionesFinanciera = [];
        $arrayObservacionesTecnica    = [];

        foreach ($result as $dato) {
            $observaciones                           = [];
            $observaciones['id_status']              = $dato->id_status;
            $observaciones['id_tramite']             = $dato->id_tramite;
            $observaciones['id_tramite_observacion'] = $dato->id;
            $observaciones['documento_padre']        = $dato->documento_padre;
            $observaciones['documento']              = $dato->documento;
            $observaciones['observacion']            = $dato->observacion;
            $observaciones['status']                 = $dato->status;
            $observaciones['status_color']           = $dato->status_color;

            switch ($dato->id_area) {
                case 2:

                    array_push($arrayObservacionesLegal, $observaciones);
                    break;
                case 3:
                    array_push($arrayObservacionesFinanciera, $observaciones);
                    break;
                case 4:
                    array_push($arrayObservacionesTecnica, $observaciones);
                    break;
            }
            unset($observaciones);
        }
        $arrayObservaciones['obsLegal']      = $arrayObservacionesLegal;
        $arrayObservaciones['obsFinanciera'] = $arrayObservacionesFinanciera;
        $arrayObservaciones['obsTecnica']    = $arrayObservacionesTecnica;

        return $arrayObservaciones;
    }

    // SAGA
    public static function totalObservaciones($data = [])
    {
        $result = T_Tramite_Observacion::select(
            't_tramites_observaciones.observacion',
            't.id_c_tramites_seguimiento',
            't_tramites_observaciones.id_status'
        );

        $result = $result->leftJoin('t_tramites as t', 't.id', '=', 't_tramites_observaciones.id_tramite');

        if ( array_key_exists('id_tramite', $data)) {
            $filtro = $data["id_tramite"];
            $result = $result->where(function ($sql) use ($filtro) {
                $sql->where('t_tramites_observaciones.id_tramite', '=', $filtro);
            });
        }
        if ( array_key_exists('id_area', $data)) {
            $filtro= $data["id_area"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('t_tramites_observaciones.id_area', $filtro);
            });
        }
        if ( array_key_exists('id_status', $data)) {
            $filtro= $data["id_status"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('t_tramites_observaciones.id_status', $filtro);
            });
        }
        if ( array_key_exists('status_t', $data)) {
            $filtro = $data["status_t"];
            $result = $result->where(function ($sql) use ($filtro) {
                $sql->where('t.id_status', '=', 2)->orWhere('t.id_status', '=', 4);
            });
        }

        $result = $result->get();
        return $result;
    }

    // SAGA
    public static function solventaciones($data=[])
    {
        $result = T_Tramite_Observacion::select(
            't_tramites_observaciones.id', 
            't_tramites_observaciones.observacion', 
            't_tramites_observaciones.observacion_solventacion',
            't_tramites_observaciones.solventado', 
            'd.id as id_documento', 
            'd.nombre as documento', 
            'cs.color as color_status', 
            'cs.nombre as status',
            't.folio as folio',
            'a.nombre as area', 
            't_tramites_observaciones.id_tramite_documentacion', 
            't_tramites_observaciones.id_status', 
            't.id_c_tramites_seguimiento'
        );
        $result=$result->leftJoin('c_documentacion as d', 'd.id', '=', 't_tramites_observaciones.id_documentacion');
        $result=$result->leftJoin('t_tramites as t', 't.id', '=', 't_tramites_observaciones.id_tramite');
        $result=$result->leftJoin('c_areas as a', 'a.id', '=', 't_tramites_observaciones.id_area');
        $result=$result->leftJoin('c_status as cs', 't_tramites_observaciones.id_status', '=', 'cs.id');    
      
        if ( array_key_exists('id_area', $data) ) {
            $filtro= $data["id_area"];
            if ( $filtro != 0 ) {
                $result= $result->where( function($sql) use ($filtro) {
                    $sql->where('t_tramites_observaciones.id_area', '=', $filtro);
                });
            }       
        }       
        if ( array_key_exists('id_documento', $data) ) {
            $filtro=$data["id_documento"];
            $result=$result->where( function($sql) use ($filtro){
                $sql->where('t_tramites_observaciones.id_documentacion', '=', $filtro);
            });
        }
        if ( array_key_exists('id_tramite', $data) ) {
            $filtro=$data["id_tramite"];
            $result=$result->where( function($sql) use ($filtro){
                $sql->where('t_tramites_observaciones.id_tramite', '=', $filtro);
            });
        }
        if ( array_key_exists('id_status', $data) ) {
            $filtro=$data["id_status"];
            $result=$result->where( function($sql) use ($filtro){
                $sql->where('t_tramites_observaciones.id_status', '=', $filtro);
            });
        }
        if ( array_key_exists('id', $data) ) {
            $filtro=$data["id"];
            $result=$result->where( function($sql) use ($filtro){
                $sql->where('t_tramites_observaciones.id', '!=', $filtro);
            });
        }
        $result=$result->where('t_tramites_observaciones.solventado', '=', 1);
        $result=$result->orderBy('t_tramites_observaciones.id', 'DESC');
        return $result;
    }  

    // SAGA
    public static function solventacionesAreas($data=[])
    {
        $result = T_Tramite_Observacion::select(
            't_tramites_observaciones.id', 
            't_tramites_observaciones.observacion',
            'td.desglose', 
            'td.path',
            't_tramites_observaciones.observacion_solventacion',
            't_tramites_observaciones.solventado', 
            'd.id as id_documento',
            'd.nombre as documento', 
            'cs.color as color_status', 
            'cs.nombre as status',
            't.folio as folio','a.nombre as area', 
            'td.id as id_tramite_documentacion',
            't_tramites_observaciones.id_status', 
            't.id_c_tramites_seguimiento'
        );
        $result=$result->join('t_tramites_documentacion as td', 't_tramites_observaciones.id', '=', 'td.id_tramite_observacion');
        $result=$result->leftJoin('c_documentacion as d', 'd.id', '=', 't_tramites_observaciones.id_documentacion');
        $result=$result->leftJoin('t_tramites as t', 't.id', '=', 't_tramites_observaciones.id_tramite');
        $result=$result->leftJoin('c_areas as a', 'a.id', '=', 't_tramites_observaciones.id_area');
        $result=$result->leftJoin('c_status as cs', 't_tramites_observaciones.id_status', '=', 'cs.id');

        if ( array_key_exists('id_tramites_observaciones', $data) ) {
            $filtro= $data["id_tramites_observaciones"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('t_tramites_observaciones.id', $filtro);
            });
        }
        if ( array_key_exists('id_tramite', $data) ) {
            $filtro= $data["id_tramite"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('t_tramites_observaciones.id_tramite','=',$filtro);
            });
        }
        if ( array_key_exists('id_area', $data) ) {
            $filtro= $data["id_area"];
            if($filtro != 0){
                $result= $result->where( function($sql) use ($filtro){
                    $sql->where('t_tramites_observaciones.id_area','=',$filtro);
                });
            }
        }
        if ( array_key_exists('id_documentacion', $data) ) {
            $filtro= $data["id_documentacion"];
            if ( $filtro != 0 ) {
                $result= $result->where( function($sql) use ($filtro){
                    $sql->where('t_tramites_observaciones.id_documentacion','=',$filtro);
                });
            }            
        }
        $result=$result->where('t_tramites_observaciones.solventado', 1);
        $result=$result->where('td.id_status', 5);
        $result=$result->whereNull('td.deleted_at');
        $result=$result->orderBy('t_tramites_observaciones.id','DESC');
        return $result;
    }
    

    public static function solventacionesEnRevision($idTramite, $idArea)
    {
        $result = T_Tramite_Observacion::select(
            't_tramites_observaciones.id_tramite',
            'c_areas.nombre as area',
            'c_status.nombre as status',
            't_tramites_observaciones.observacion',
            't_tramites_observaciones.solventado'
        );
        $result = $result->join('c_areas', 't_tramites_observaciones.id_area', '=', 'c_areas.id');
        $result = $result->join('c_status', 't_tramites_observaciones.id_status', '=', 'c_status.id');
        $result = $result->where('t_tramites_observaciones.solventado', 1);
        $result = $result->where('t_tramites_observaciones.id_area', $idArea);
        $result = $result->where('t_tramites_observaciones.id_tramite', $idTramite);
        return $result;
    }

    public static function observaciones($data = [])
     {
        // Autor: Sandro Alan Gomez Aceituno
        // Modificacion: 20 de Abril de 2022
        // Descripción: Lista todas las observaciones que mandaron las áreas en el portal.

        $result = T_Tramite_Observacion::select(
            't_tramites_observaciones.id',
            't_tramites_observaciones.observacion',
            't_tramites_observaciones.id_tramite',
            't_tramites_observaciones.solventado',
            'd.id as id_documento',
            'd.nombre as documento',
            'cs.color as color_status',
            't.id_status as id_status_tramite',
            't.folio as folio',
            'a.nombre as area',
            'cs.nombre as status',
            't_tramites_observaciones.id_status',
            'cd.nombre as padre',
            't_tramites_observaciones.id_documentacion'
        );
        $result = $result->leftJoin('c_documentacion as d', 'd.id', '=', 't_tramites_observaciones.id_documentacion');
        $result = $result->leftJoin('t_tramites as t', 't.id', '=', 't_tramites_observaciones.id_tramite');
        $result = $result->leftJoin('c_areas as a', 'a.id', '=', 't_tramites_observaciones.id_area');
        $result = $result->leftJoin('c_status as cs', 't_tramites_observaciones.id_status', '=', 'cs.id');
        $result = $result->leftJoin('c_documentacion as cd', 'cd.id', '=', 'd.id_padre');
        $result = $result->where('t.id_status', '>=', 3);

        if (array_key_exists('id_documento', $data)) {
            $filtro = $data["id_documento"];
            $result = $result->where(function ($sql) use ($filtro) {
                $sql->where('t_tramites_observaciones.id_documentacion', '=', $filtro);
            });
        }

        /*
        if (array_key_exists('id_c_tramites_seguimiento', $data)) {
            $filtro = $data["id_c_tramites_seguimiento"];
            $result = $result->where(function ($sql) use ($filtro) {
                $sql->where('t.id_c_tramites_seguimiento', '=', 2);
            });
        }
        */

        if (array_key_exists('id_tramite', $data)) {
            $filtro = $data["id_tramite"];
            $result = $result->where(function ($sql) use ($filtro) {
                $sql->where('t_tramites_observaciones.id_tramite', '=', $filtro);
            });
        }

        if (array_key_exists('id_status', $data)) {
            $filtro = $data["id_status"];
            $result = $result->where(function ($sql) use ($filtro) {
                $sql->where('t_tramites_observaciones.id_status', '=', $filtro);
            });
        }

        if (array_key_exists('id_tramite_observacion', $data)) {
            $filtro = $data["id_tramite_observacion"];
            $result = $result->where(function ($sql) use ($filtro) {
                $sql->where('t_tramites_observaciones.id', '=', $filtro);
            });
        }

        if (array_key_exists('id', $data)) {
            $filtro = $data["id"];
            $result = $result->where(function ($sql) use ($filtro) {
                $sql->where('t_tramites_observaciones.id', '!=', $filtro);
            });
        }

        $result = $result->orderBy('t_tramites_observaciones.id', 'DESC');
        return $result;
     }

    public static function solventaciones_subidas($data = [])
    {
        // Autor: Sandro Alan Gomez Aceituno
        // Modificacion: 20 de Abril de 2022
        // Descripción: Muestras los documentos subidos por solventación.

        $result = T_Tramite_Observacion::select(
            't_tramites_observaciones.id_tramite',
            't_tramites.id_status AS id_status_tramite',
            't_tramites_observaciones.id as id_tramite_observacion',
            't_tramites_documentacion.id as id_tramite_documentacion',
            'c_areas.nombre as area',
            'c_status.nombre as status',
            't_tramites_observaciones.observacion',
            't_tramites_documentacion.desglose'
        );
        $result = $result->leftJoin('t_tramites', 't_tramites_observaciones.id_tramite', '=', 't_tramites.id');
        $result = $result->join('t_tramites_documentacion', 't_tramites_observaciones.id', '=', 't_tramites_documentacion.id_tramite_observacion');
        $result = $result->join('c_areas', 't_tramites_observaciones.id_area', '=', 'c_areas.id');
        $result = $result->join('c_status', 't_tramites_observaciones.id_status', '=', 'c_status.id');

        if (array_key_exists('id_tramites_observaciones', $data)) {
            $filtro = $data["id_tramites_observaciones"];
            $result = $result->where(function ($sql) use ($filtro) {
                $sql->where('t_tramites_observaciones.id', $filtro);
            });
        }
        $result = $result->where('t_tramites_documentacion.id_status', 5);
        $result = $result->whereNull('t_tramites_documentacion.deleted_at');
        return $result;
    }

    public static function lstObservaciones($id_tramite)
    {
        //SAGA
        $result = T_Tramite_Observacion::select('t_tramites_observaciones.*', 'cd.nombre as padre', 'd.nombre as documento');
        $result = $result->leftJoin('t_tramites as t', 't.id', '=', 't_tramites_observaciones.id_tramite');
        $result = $result->leftJoin('c_documentacion as d', 'd.id', '=', 't_tramites_observaciones.id_documentacion');
        $result = $result->leftJoin('c_documentacion as cd', 'cd.id', '=', 'd.id_padre');

        $result = $result->where('t_tramites_observaciones.id_tramite', $id_tramite);
        $result = $result->where('t.id_c_tramites_seguimiento', '>=', 2)->get();

        $ar_doctos        = [];
        $array            = [];
        $array_legal      = [];
        $array_tecnica    = [];
        $array_financiera = [];

        foreach ($result as $ar) {

            switch ($ar->id_area) {
                case 2:
                    $vdocumentoPadreHijo = $ar->documento . '.- ' . $ar->observacion;
                    if ($ar->padre != '' || $ar->padre == null) {
                        $vdocumentoPadreHijo = '<b>' . $ar->padre . '</b> ' . $ar->documento . '.- ' . $ar->observacion;
                    }
                    $array_legal[$ar->id] = strip_tags($vdocumentoPadreHijo);
                    break;
                case 3:
                    $vdocumentoPadreHijo = $ar->documento . '.- ' . $ar->observacion;
                    if ($ar->padre != '' || $ar->padre == null) {
                        $vdocumentoPadreHijo = '<b>' . $ar->padre . '</b> ' . $ar->documento . '.- ' . $ar->observacion;
                    }
                    $array_financiera[$ar->id] = strip_tags($vdocumentoPadreHijo);
                    break;
                case 4:
                    $vdocumentoPadreHijo = $ar->documento . '.- ' . $ar->observacion;
                    if ($ar->padre != '' || $ar->padre == null) {
                        $vdocumentoPadreHijo = '<b>' . $ar->padre . '</b> ' . $ar->documento . '.- ' . $ar->observacion;
                    }
                    $array_tecnica[$ar->id] = strip_tags($vdocumentoPadreHijo);
                    break;
            }
        }
        $ar_doctos["Área legal"]      = $array_legal;
        $ar_doctos["Área financiera"] = $array_financiera;
        $ar_doctos["Área técnica"]   = $array_tecnica;

        return $ar_doctos;
    }

    public static function general($data = [])
    {
        $result = T_Tramite_Observacion::select(
            't_tramites_observaciones.id',
            't_tramites_observaciones.observacion',
            't_tramites_observaciones.solventado',
            'd.id as id_documento',
            'd.nombre as documento'
        );
        $result = $result->leftJoin('c_documentacion as d', 'd.id', '=', 't_tramites_observaciones.id_documentacion');
        $result = $result->leftJoin('t_tramites as t', 't.id', '=', 't_tramites_observaciones.id_tramite');

        if (array_key_exists('id_documento', $data)) {
            $filtro = $data["id_documento"];
            $result = $result->where(function ($sql) use ($filtro) {
                $sql->where('t_tramites_observaciones.id_documentacion', '=', $filtro);
            });
        }

        if (array_key_exists('id_c_tramites_seguimiento', $data)) {
            $filtro = $data["id_c_tramites_seguimiento"];
            $result = $result->where(function ($sql) use ($filtro) {
                $sql->where('t.id_c_tramites_seguimiento', '=', 2);
            });
        }

        if (array_key_exists('id_tramite', $data)) {
            $filtro = $data["id_tramite"];
            $result = $result->where(function ($sql) use ($filtro) {
                $sql->where('t_tramites_observaciones.id_tramite', '=', $filtro);
            });
        }

        if (array_key_exists('id_status', $data)) {
            $filtro = $data["id_status"];
            $result = $result->where(function ($sql) use ($filtro) {
                $sql->where('t_tramites_observaciones.id_status', '=', $filtro);
            });
        }

        if (array_key_exists('id', $data)) {
            $filtro = $data["id"];
            $result = $result->where(function ($sql) use ($filtro) {
                $sql->where('t_tramites_observaciones.id', '!=', $filtro);
            });
        }
        $result = $result->orderBy('t_tramites_observaciones.id', 'DESC');
        return $result;
    }
}
