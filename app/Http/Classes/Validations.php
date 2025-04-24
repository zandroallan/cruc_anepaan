<?php
namespace App\Http\Classes;

class Validations
{
    private $status_b;
    private $status_code;
    private $status_msg;

    public function __construct()
    {
        $this->status_b    = false;
        $this->status_code = 201;
        $this->status_msg  = '';
    }

    public function getStatusB()
    {
        return $this->status_b;
    }

    public function getStatusCode()
    {
        return $this->status_code;
    }

    public function getStatusMsg()
    {
        return $this->status_msg;
    }

    //Errores Crear cuenta
    public function crearCuentaNueva($post)
    {
        if (\App\User::general(['nickname' => $post['nickname']])->count() > 0) {
            $this->status_b    = true;
            $this->status_code = 409;
            $this->status_msg  = 'Ya existe una cuenta con el nombre de usuario <b>"' . $post['nickname'] . '"</b>. <br>Por favor intente con un nombre de usuario distinto.';
        }
        if (\App\User::general(['rfc' => $post['rfc']])->count() > 0) {
            $this->status_b    = true;
            $this->status_code = 409;
            $this->status_msg  = 'Ya existe una cuenta creada para el R.F.C <b>"' . $post['rfc'] . '"</b>. <br>Si usted no ha creado dicha cuenta comuniquese a los números 01(961) 61 8 75 30 Ext. 22022 y 22232.';
        }
    }

    public function agregarEspecialidad($array, $id_especialidad)
    {
        # New SAGA
        if (in_array($id_especialidad, $array)) {
            $this->status_b = true;
            $this->status_code = 409;
            $this->status_msg = 'Ya existe esta especialdiad en el trámite. <br>Por favor eliminelo y vuelva a intentar.';
        }
    }

    public function datosLegalesNuevo($post, $id)
    {
        # New SAGA
        $this->status_b = false;
        if ($id == 0) {
            if (\App\Http\Models\Backend\T_Tramite_Dato_Legal::general(['id_registro_tmp' => $post['id_registro_tmp'], 'id' => $post['id']])->count() > 0) {
                $this->status_b = true;
                $this->status_code = 409;
                $this->status_msg = 'Ya existe información general del módulo <b>Área Legal</b> para este trámite. <br>Por favor eliminelo y vuelva a intentar.';
            }
        }
    }

    public function actaConstitutivaNuevo($post)
    {
        # New SAGA
        if (\App\Http\Models\Backend\T_Tramite_Acta_Instrumento::general(['id_registro_tmp' => $post['id_registro_tmp'], 'id' => $post['id'], 'id_tipo_acta_instrumento' => $post['id_tipo_acta_instrumento']])->count() > 0) {
            $this->status_b = true;
            $this->status_code = 409;
            $this->status_msg = 'Ya existe información capturada del <b>Acta Constitutiva</b> en el módulo <b>Área Legal</b> para este trámite. <br>Por favor eliminelo y vuelva a intentar.';
        }
    }

    public function repLegalNuevo($post)
    {
        # New SAGA
        if (\App\Http\Models\Backend\T_Tramite_Rep_Legal::general(['id_registro_tmp' => $post['id_registro_tmp'], 'id' => $post['id']])->count() > 0) {
            $this->status_b = true;
            $this->status_code = 409;
            $this->status_msg = 'Ya existe un <b>representante legal</b> capturado en el módulo <b>Área Legal</b> para este trámite. <br>Por favor eliminelo y vuelva a intentar.';
        }
    }

    public function repLegalUpdate()
    {
        # New SAGA  
        $this->status_b    = false;
        $this->status_code = 200;
        $this->status_msg  = 'Ok';
    }

    //Errores Caratula
    public function registroNuevo($post, $send = 0)
    {

        /*if(\App\Http\Models\Backend\T_Registro::general(['id'=>$post['id'], 'rfc'=>$post['rfc']])->count()>0){
            $this->status_b    = true;
            $this->status_code = 409;
            $this->status_msg  = 'Ya existe un registro con el R.F.C <b>"'.$post['rfc'].'"</b>. <br>Por favor verifique la información.';
        }*/

        if ($send == 1) {

            $documentacion_subida = \App\Http\Models\Backend\T_Tramite_Documentacion::documentacion_temporal_array($post['id']);

            $registro = \App\Http\Models\Backend\T_Registro::find($post['id']);
            $id_sujeto = $registro->id_sujeto;
            $id_tipo_persona = $registro->id_tipo_persona;
            $id_tipo_tramite = $post['id_tipo_tramite'];
            $tec_acredita_tmp = $registro->tec_acredita_tmp;
            $obligado_dec_isr = $registro->obligado_dec_isr;

            if ($id_tipo_tramite != 1) {
                $tec_acredita_tmp = 0;
            }
            $doc_obligatoria_legal = \App\Http\Models\Catalogos\C_Documentacion::documentos_obligatorios($id_tipo_tramite, $id_sujeto, $id_tipo_persona, 2);
            $doc_obligatoria_financiera = \App\Http\Models\Catalogos\C_Documentacion::documentos_obligatorios($id_tipo_tramite, $id_sujeto, $id_tipo_persona, 3, $obligado_dec_isr);
            $doc_obligatoria_tecnica = \App\Http\Models\Catalogos\C_Documentacion::documentos_obligatorios($id_tipo_tramite, $id_sujeto, $id_tipo_persona, 4, $tec_acredita_tmp);
            $documentacion_requerida =  array_merge($doc_obligatoria_legal, $doc_obligatoria_financiera, $doc_obligatoria_tecnica);

            $diff = array_diff($documentacion_requerida, $documentacion_subida);
            if (count($diff) > 0) {
                $this->status_b    = true;
                $this->status_code = 409;
                $areas = [2 => "<b>Área legal</b>", 3 => "<b>Área financiera</b>", 4 => "<b>Área técnica</b>"];
                $string = "";
                $id_last_area = 0;
                $i = 0;
                $total = count($diff);
                foreach ($diff as $val) {
                    $docto = \App\Http\Models\Catalogos\C_Documentacion::find($val);
                    if ($id_last_area != $docto->id_area) {
                        if ($i != 0) {
                            $string .= "</ol>";
                        }
                        $string .= "<h2>" . $areas[$docto->id_area] . "</h2>";
                        $string .= "<ol>";
                        $id_last_area = $docto->id_area;
                    }

                    $string .= "<li>" . $docto->nombre . "</li>";
                    $i++;
                    if ($i == $total) {
                        $string .= "<ol>";
                    }
                }

                $this->status_msg  = 'Documentación <b>Incompleta</b>; es necesario suba todos los documentos requeridos. <br><br>' . $string;
            }
        }
    }

    public function registroSubirDocumento($post)
    {
        if (\App\Http\Models\Backend\T_Tramite_Documentacion::general(['id_tramite' => $post['id_tramite'], 'id_documento' => $post['id_documento']])->count() > 0) {
            $this->status_b    = true;
            $this->status_code = 409;
            $this->status_msg  = 'Ya existe un archivo adjunto de este documento. <br>Por favor eliminelo y vuelva a intentar.';
        }
    }

    //Subir documento temporal (Nuevo trámite)    
    public function registroSubirDocumentoTmp($post)
    {
        $docto = \App\Http\Models\Catalogos\C_Documentacion::find($post['id_documento']);
        if ($docto->subir_n == 0) {
            if (\App\Http\Models\Backend\T_Tramite_Documentacion::general(['id_registro_temp' => $post['id_registro'], 'id_documento' => $post['id_documento'], 'id_tramite_null' => 0])->count() > 0) {
                $this->status_b    = true;
                $this->status_code = 409;
                $this->status_msg  = 'Ya existe un archivo adjunto de este documento. <br>Por favor eliminelo y vuelva a intentar.';
            }
        }
    }

    //Errores Caratula
    public function beneficiarioNew($post)
    {
        if (\App\Http\Models\Beneficiario::search(['id' => $post['id'], 'nombre' => $post['nombre']])->count() > 0) {
            $this->status_b    = true;
            $this->status_code = 409;
            $this->status_msg  = 'Ya existe una beneficiario de nombre <br><b>"' . $post['nombre'] . '</b>" <br>Porfavor verifique la información.';
        }
        if (\App\Http\Models\Beneficiario::search(['id' => $post['id'], 'folio_etiqueta' => $post['folio_etiqueta']])->count() > 0) {
            $this->status_b    = true;
            $this->status_code = 409;
            $this->status_msg  = 'El folio <b>"' . $post['folio_etiqueta'] . '"</b> ya ha sido asignado a otro beneficiario." <br>Porfavor verifique la información.';
        }
    }

    public function socioLegalNuevo($post)
    {
        //if(\App\Http\Models\Backend\T_Tramite_Socio_Legal::general(['id_tramite'=>$post['id_tramite'], 'id'=>$post['id'], 'nombre_completo'=>$post['nombre_completo']])->count()>0){
        if (\App\Http\Models\Backend\T_Tramite_Socio_Legal::general(['id_registro_temp' => $post['id_registro_temp'], 'id' => $post['id'], 'nombre_completo' => $post['nombre_completo']])->count() > 0) {
            $this->status_b    = true;
            $this->status_code = 409;
            $this->status_msg  = 'Ya existe un <b>socio legal</b> con este nombre  en el módulo <b>Área Legal</b> para este trámite. <br>Por favor eliminelo y vuelva a intentar.';
        }
    }

    public function repTecnicoNuevo($post)
    {
        if (count(\App\Http\Models\Backend\T_Tramite_Rep_Tecnico::getRepTecnicoTMP(['id_registro_tmp' => $post['id_registro_tmp'], 'id' => $post['id'], 'curp' => $post['curp']])->get()) > 0) {
            $this->status_b    = true;
            $this->status_code = 409;
            $this->status_msg  = 'Ya existe un registro con este <b>representante técnico</b> en el módulo <b>Área Técnica</b> para este trámite. <br>Por favor eliminelo y vuelva a intentar.';
        }

        //Se agregó 'id_cs'=>$post['id_registro_tmp'] para que permita usar la misma constancia en la misma empresa si es modificaion  en el año. Feha de actualizacion 24 SEP 2021
        $rtecs_constancia = \App\Http\Models\Backend\T_Tramite_Rep_Tecnico::getRepTecnicoTMP(['anio' => date('Y'), 'id' => $post['id'], 'curp' => $post['curp'], 'id_tipo_constancia' => $post['id_tipo_constancia'], 'id_cs' => $post['id_registro_tmp']])->get();
        if (count($rtecs_constancia)) {
            $this->status_b    = true;
            $this->status_code = 409;
            $this->status_msg  = 'El tipo de constancia del <b>representante técnico</b> ya ha sido utilizada este año. <br>Por favor eliminelo y vuelva a intentar.';
        }
    }
}
