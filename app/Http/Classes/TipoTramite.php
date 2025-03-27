<?php
namespace App\Http\Classes;

class TipoTramite
{

    private $status_b;
    private $status_code;
    private $status_msg;

    public function __construct()
    {
        $this->id_tipo_tramite  = 1;
        $this->tipo_tramite_msg = "";
    }

    public function getTipoTramite()
    {
        return $this->id_tipo_tramite;
    }

    public function getTipoTramiteMsg()
    {
        return $this->tipo_tramite_msg;
    }

    public function getNewTramite($ultimo_tramite)
    {
        // 1.- Inscripción 2.- Actualización 3.- Modificacion 88.-Trámite en proceso 89.-Trámite en proceso con observaciones 99.- Trámite cancelado 100.- Trámite paso a juridico
        $id_tipo_tramite_new    = 1;
        $this->tipo_tramite_msg = "Inscripción";
        //$ultimo_tramite= \App\Http\Models\Backend\T_registro::get_ultimo_tramite($rfc);
        if (isset($ultimo_tramite)) {
            $id_tipo_tramite_ultimo = $ultimo_tramite->id_tipo_tramite;
            $anio_ultimo            = $ultimo_tramite->anio;
            $status_ultimo          = $ultimo_tramite->id_status;
            $anio_actual            = date('Y');

            if ($anio_ultimo == $anio_actual) {
                switch ($status_ultimo) {
                    case 1:
                        $id_tipo_tramite_new    = 3;
                        $this->tipo_tramite_msg = "Modificación";
                        break;
                    case 2:
                        $id_tipo_tramite_new    = 88;
                        $this->tipo_tramite_msg = "Trámite en proceso";
                        break;
                    case 3:
                        $id_tipo_tramite_new    = $id_tipo_tramite_ultimo;
                        $this->tipo_tramite_msg = $ultimo_tramite->tipo_de_tramite;
                        break;
                    case 4:
                        $id_tipo_tramite_new    = 89;
                        $this->tipo_tramite_msg = "Trámite en proceso con observaciones";
                        break;
                    case 5:
                        $id_tipo_tramite_new    = 90;
                        $this->tipo_tramite_msg = "Trámite en proceso con solventaciones en revisión enviadas a la Secretaria";
                        break;
                    case 6:
                        $id_tipo_tramite_new    = 100;
                        $this->tipo_tramite_msg = "Trámite en jurídico";
                        break;
                }
            }
            else {
                if ($anio_ultimo == ($anio_actual - 1)) {
                    switch ($status_ultimo) {
                        case 1:
                            $id_tipo_tramite_new    = 2;
                            $this->tipo_tramite_msg = "Actualización";
                            break;
                        case 2:
                            $id_tipo_tramite_new    = 1;
                            $this->tipo_tramite_msg = "Inscripción";
                            break;
                        case 3:
                            $id_tipo_tramite_new    = 1;
                            $this->tipo_tramite_msg = "Inscripción";
                            break;
                    }
                }
                else {
                    $id_tipo_tramite_new    = 1;
                    $this->tipo_tramite_msg = "Inscripción";

                    // if ($anio_ultimo == 2019 && ($id_tipo_tramite_ultimo == 3 || $id_tipo_tramite_ultimo == 2 || $id_tipo_tramite_ultimo == 1) && $status_ultimo == 1) {
                    //     $id_tipo_tramite_new    = 2;
                    //     $this->tipo_tramite_msg = "Actualización";
                    // }
                }
            }
        }
        $this->id_tipo_tramite = $id_tipo_tramite_new;
        return $id_tipo_tramite_new;
    }
}
