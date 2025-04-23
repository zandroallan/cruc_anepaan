<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class SubirDocumentoSoporte extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id_documento_soporte = $this->input('id_documento_soporte');
        $array                = $this->input('files');
        $rules                = ['id_documento_soporte' => 'required|not_zero'];
        switch ($id_documento_soporte) {
            // case 174:
            //     $rules = [
            //         'id_documento_soporte'     => 'required|not_zero',
            //         'files.relacion_analitica' => 'required|file|mimes:pdf|max:40960',
            //         'files.estado_cuenta'      => 'required|file|mimes:pdf|max:40960',
            //     ];
            //     break;
            // case 175:
            //     $rules = [
            //         'id_documento_soporte'     => 'required|not_zero',
            //         'files.relacion_analitica' => 'required|file|mimes:pdf|max:100960',
            //         // 'files.estado_cuenta'    => 'required|file|mimes:pdf|max:40960',
            //         'files.facturas_xml'       => 'required|file|mimes:pdf,xml|max:100960',
            //         // 'files.contrato'         => 'required|file|mimes:pdf|max:40960'
            //     ];
            //     break;
            // case 176:
            //     $rules = [
            //         'id_documento_soporte'     => 'required|not_zero',
            //         'files.pagare'             => 'required|file|mimes:pdf|max:100960',
            //         'files.estado_cuenta'      => 'required|file|mimes:pdf|max:100960',
            //         'files.contrato'           => 'required|file|mimes:pdf|max:100960',
            //         'files.relacion_analitica' => 'required|file|mimes:pdf|max:100960',
            //     ];
            //     break;
            // case 177:
            //     $rules = [
            //         'id_documento_soporte'     => 'required|not_zero',
            //         'files.relacion_analitica' => 'required|file|mimes:pdf|max:40960',
            //         'files.facturas'           => 'required|file|mimes:pdf|max:40960',
            //         'files.estado_cuenta'      => 'required|file|mimes:pdf|max:40960',
            //         //  opcional
            //         // 'files.contrato'         => 'required|file|mimes:pdf|max:40960'
            //     ];
            //     break;
            // case 178:
            //     $rules = [
            //         'id_documento_soporte'     => 'required|not_zero',
            //         'files.relacion_analitica' => 'required|file|mimes:pdf|max:40960',
            //         'files.facturas_xml'       => 'required|file|mimes:pdf,xml|max:40960',
            //     ];
            //     break;
            // case 179:
            //     $rules = [
            //         'id_documento_soporte'     => 'required|not_zero',
            //         'files.relacion_analitica' => 'required|file|mimes:pdf|max:40960',
            //         'files.facturas_xml'       => 'required|file|mimes:pdf,xml|max:40960',
            //     ];
            //     break;
            // case 180:
            //     $rules = [
            //         'id_documento_soporte'     => 'required|not_zero',
            //         'files.relacion_analitica' => 'required|file|mimes:pdf|max:100960',
            //         'files.escritura_publica'  => 'required|file|mimes:pdf|max:100960',
            //         'files.pago_predial'       => 'required|file|mimes:pdf|max:100960',
            //         // opcional
            //         // 'files.avaluo'           => 'required|file|mimes:pdf|max:40960',
            //     ];
            //     break;
            // case 181:
            //     $rules = [
            //         'id_documento_soporte'      => 'required|not_zero',
            //         'files.relacion_analitica'  => 'required|file|mimes:pdf|max:100960',
            //         'files.facturas_xml'        => 'required|file|mimes:pdf,xml|max:100960',
            //         'files.reporte_fotografico' => 'required|file|mimes:pdf|max:100960',
            //     ];
            //     break;
            // case 182:
            //     $rules = [
            //         'id_documento_soporte'     => 'required|not_zero',
            //         'files.relacion_analitica' => 'required|file|mimes:pdf|max:40960',
            //         'files.facturas_xml'       => 'required|file|mimes:pdf,xml|max:40960',
            //     ];
            //     break;
            // case 183:
            //     $rules = [
            //         'id_documento_soporte'     => 'required|not_zero',
            //         'files.relacion_analitica' => 'required|file|mimes:pdf|max:40960',
            //         'files.facturas'           => 'required|file|mimes:pdf|max:40960',
            //         'files.pago_refrendo'      => 'required|file|mimes:pdf|max:40960',
            //         // 'files.tarjeta_circulacion'      => 'required|file|mimes:pdf|max:40960'
            //     ];
            //     break;
            // case 184:
            //     $rules = [
            //         'id_documento_soporte'     => 'required|not_zero',
            //         'files.relacion_analitica' => 'required|file|mimes:pdf|max:40960',
            //         'files.facturas_xml'       => 'required|file|mimes:pdf,xml|max:40960',
            //     ];
            //     break;
            // case 185:
            //     $rules = [
            //         'id_documento_soporte'     => 'required|not_zero',
            //         'files.relacion_analitica' => 'required|file|mimes:pdf|max:40960',
            //         'files.facturas_xml'       => 'required|file|mimes:pdf,xml|max:40960',
            //     ];
            //     break;
            case 240:
                $rules = [
                    'id_documento_soporte' => 'required|not_zero',
                    'files.contrato'       => 'required|file|mimes:pdf|max:40960',
                    'files.acta_entrega'   => 'required|file|mimes:pdf,xml|max:40960',
                    'files.finiquito_obra' => 'required|file|mimes:pdf,xml|max:40960',
                    'files.finiquito_factura' => 'required|file|mimes:pdf,xml|max:40960',
                ];
                break;

            case 244:
                $rules = [
                    'id_documento_soporte' => 'required|not_zero',
                    'files.contrato'       => 'required|file|mimes:pdf|max:40960',
                    'files.fianzas'        => 'required|file|mimes:pdf,xml|max:40960',
                    'files.reporte_avance' => 'required|file|mimes:pdf,xml|max:40960',
                    'files.estimacion'     => 'required|file|mimes:pdf,xml|max:80960',
                    'files.factura_pago'   => 'required|file|mimes:pdf,xml|max:40960',
                ];
                break;
            case 245:
                $rules = [
                    'id_documento_soporte'      => 'required|not_zero',
                    'files.constancia_registro' => 'required|file|mimes:pdf|max:40960',
                ];
                break;
            case 246:
                $rules = [
                    'id_documento_soporte'  => 'required|not_zero',
                    'files.constancia_rtec' => 'required|file|mimes:pdf|max:40960',
                ];
                break;

            case 251:
                $rules = [
                    'id_documento_soporte' => 'required|not_zero',
                    'files.contrato'       => 'required|file|mimes:pdf|max:40960',
                    'files.acta_entrega'   => 'required|file|mimes:pdf,xml|max:40960',
                    'files.finiquito_obra' => 'required|file|mimes:pdf,xml|max:40960',
                    // son opcionales
                    // 'files.nombramiento_residente'   => 'required|file|mimes:pdf,xml|max:40960',
                    // 'files.notas_bitacora'           => 'required|file|mimes:pdf,xml|max:40960'

                ];
                break;
            case 252:
                $rules = [
                    'id_documento_soporte' => 'required|not_zero',
                    'files.contrato'       => 'required|file|mimes:pdf|max:40960',
                    'files.fianzas'        => 'required|file|mimes:pdf,xml|max:40960',
                    'files.reporte_avance' => 'required|file|mimes:pdf,xml|max:40960',
                    'files.estimacion'     => 'required|file|mimes:pdf,xml|max:80960',
                    'files.factura_pago'   => 'required|file|mimes:pdf,xml|max:40960',
                ];
                break;
            case 256:
                $rules = [
                    'id_documento_soporte' => 'required|not_zero',
                    'files.contrato'       => 'required|file|mimes:pdf|max:40960',
                    'files.acta_entrega'   => 'required|file|mimes:pdf,xml|max:40960',
                    'files.finiquito_obra' => 'required|file|mimes:pdf,xml|max:40960',
                    'files.facturas_xml'   => 'required|file|mimes:pdf,xml|max:40960',
                    // 'files.nombramiento_residente'   => 'required|file|mimes:pdf,xml|max:40960',
                    // 'files.notas_bitacora'           => 'required|file|mimes:pdf,xml|max:40960'

                ];
                break;
            case 257:
                $rules = [
                    'id_documento_soporte' => 'required|not_zero',
                    'files.contrato'       => 'required|file|mimes:pdf|max:40960',
                    'files.fianzas'        => 'required|file|mimes:pdf,xml|max:40960',
                    'files.reporte_avance' => 'required|file|mimes:pdf,xml|max:40960',
                    'files.estimacion'     => 'required|file|mimes:pdf,xml|max:80960',
                    'files.factura_pago'   => 'required|file|mimes:pdf,xml|max:40960',
                ];
                break;

            case 258:
                $rules = [
                    'id_documento_soporte'     => 'required|not_zero',
                    'files.curriculum_empresa' => 'required|file|mimes:pdf|max:40960',
                    'files.curriculum_rtec'    => 'required|file|mimes:pdf,xml|max:40960',
                    'files.cedula'             => 'required|file|mimes:pdf,xml|max:40960',
                    'files.curp'               => 'required|file|mimes:pdf,xml|max:40960',
                    'files.ine_ife'            => 'required|file|mimes:pdf,xml|max:40960',
                    'files.constancia'         => 'file|mimes:pdf,xml|max:40960',
                ];
                break;
            case 259:
                $rules = [
                    'id_documento_soporte'     => 'required|not_zero',
                    'files.constancia_colegio' => 'required|file|mimes:pdf|max:40960',
                    'files.curriculum_empresa' => 'required|file|mimes:pdf|max:40960',
                    'files.curriculum_rtec'    => 'required|file|mimes:pdf,xml|max:40960',
                    'files.cedula'             => 'required|file|mimes:pdf,xml|max:40960',
                    'files.curp'               => 'required|file|mimes:pdf,xml|max:40960',
                    'files.ine_ife'            => 'required|file|mimes:pdf,xml|max:40960',
                    'files.constancia'         => 'file|mimes:pdf,xml|max:40960',
                ];
                break;
            case 260:
                $rules = [
                    'id_documento_soporte' => 'required|not_zero',
                    'files.contrato'       => 'required|file|mimes:pdf|max:40960',
                    'files.acta_entrega'   => 'required|file|mimes:pdf,xml|max:40960',
                    'files.finiquito_obra' => 'required|file|mimes:pdf,xml|max:40960',
                    // son opcionales
                    // 'files.nombramiento_residente'   => 'required|file|mimes:pdf,xml|max:40960',
                    // 'files.notas_bitacora'           => 'required|file|mimes:pdf,xml|max:40960'

                ];
                break;
            // case 266:
            //     $rules = [
            //         'files-alias'                 => 'required',
            //         'id_documento_soporte'        => 'required|not_zero',
            //         'files.relacion_analitica'    => 'required|file|mimes:pdf|max:40960',
            //         'files.documentacion_soporte' => 'required|file|mimes:pdf|max:40960',
            //     ];
            //     break;
            case 267:
                $rules = [
                    'id_documento_soporte' => 'required|not_zero',
                    'files.contrato'       => 'required|file|mimes:pdf|max:40960',
                    'files.acta_entrega'   => 'required|file|mimes:pdf,xml|max:40960',
                    'files.finiquito_obra' => 'required|file|mimes:pdf,xml|max:40960',
                    // son opcionales
                    // 'files.nombramiento_residente'   => 'required|file|mimes:pdf,xml|max:40960',
                    // 'files.notas_bitacora'           => 'required|file|mimes:pdf,xml|max:40960'

                ];
                break;
            case 268:
                $rules = [
                    'id_documento_soporte'         => 'required|not_zero',
                    'files.contrato'               => 'required|file|mimes:pdf|max:40960',
                    'files.acta_entrega'           => 'required|file|mimes:pdf,xml|max:40960',
                    'files.finiquito_obra'         => 'required|file|mimes:pdf,xml|max:40960',
                    'files.facturas_xml'           => 'required|file|mimes:pdf,xml|max:40960',
                    'files.nombramiento_residente' => 'required|file|mimes:pdf,xml|max:40960',
                    'files.notas_bitacora'         => 'required|file|mimes:pdf,xml|max:40960',

                ];
                break;
            case 269:
                $rules = [
                    'id_documento_soporte' => 'required|not_zero',
                    'files.contrato'       => 'required|file|mimes:pdf|max:40960',
                    'files.acta_entrega'   => 'required|file|mimes:pdf,xml|max:40960',
                    'files.finiquito_obra' => 'required|file|mimes:pdf,xml|max:40960',
                    //son opcionales
                    // 'files.nombramiento_residente'   => 'required|file|mimes:pdf,xml|max:40960',
                    // 'files.notas_bitacora'           => 'required|file|mimes:pdf,xml|max:40960'

                ];
                break;
            case 270:
                $rules = [
                    'id_documento_soporte' => 'required|not_zero',
                    'files.contrato'       => 'required|file|mimes:pdf|max:40960',
                    'files.acta_entrega'   => 'required|file|mimes:pdf,xml|max:40960',
                    'files.finiquito_obra' => 'required|file|mimes:pdf,xml|max:40960',
                ];
                break;
            case 271:
                $rules = [
                    'id_documento_soporte' => 'required|not_zero',
                    'files.contrato'       => 'required|file|mimes:pdf|max:40960',
                    'files.fianzas'        => 'required|file|mimes:pdf,xml|max:40960',
                    'files.reporte_avance' => 'required|file|mimes:pdf,xml|max:40960',
                    'files.estimacion'     => 'required|file|mimes:pdf,xml|max:80960',
                    'files.factura_pago'   => 'required|file|mimes:pdf,xml|max:40960',
                ];
                break;
            case 272:
                $rules = [
                    'id_documento_soporte'         => 'required|not_zero',
                    'files.contrato'               => 'required|file|mimes:pdf|max:40960',
                    'files.fianzas'                => 'required|file|mimes:pdf,xml|max:40960',
                    'files.reporte_avance'         => 'required|file|mimes:pdf,xml|max:40960',
                    'files.estimacion'             => 'required|file|mimes:pdf,xml|max:80960',
                    'files.factura_pago'           => 'required|file|mimes:pdf,xml|max:40960',
                    'files.nombramiento_residente' => 'required|file|mimes:pdf,xml|max:40960',
                ];
                break;
            case 273:
                $rules = [
                    'id_documento_soporte' => 'required|not_zero',
                    'files.contrato'       => 'required|file|mimes:pdf|max:40960',
                    'files.fianzas'        => 'required|file|mimes:pdf,xml|max:40960',
                    'files.reporte_avance' => 'required|file|mimes:pdf,xml|max:40960',
                    'files.estimacion'     => 'required|file|mimes:pdf,xml|max:80960',
                    'files.factura_pago'   => 'required|file|mimes:pdf,xml|max:40960',
                ];
                break;
            case 274:
                $rules = [
                    'id_documento_soporte'  => 'required|not_zero',
                    'files.cedula'          => 'required|file|mimes:pdf|max:40960',
                    'files.curp'            => 'required|file|mimes:pdf,xml|max:40960',
                    'files.ife_ine'         => 'required|file|mimes:pdf,xml|max:40960',
                    'files.curriculum_rtec' => 'required|file|mimes:pdf,xml|max:40960',

                ];
                break;

            case 276:
                $rules = [
                    'id_documento_soporte' => 'required|not_zero',
                    'files.contrato'       => 'required|file|mimes:pdf|max:40960',
                    'files.fianzas'        => 'required|file|mimes:pdf,xml|max:40960',
                    'files.reporte_avance' => 'required|file|mimes:pdf,xml|max:40960',
                    'files.estimacion'     => 'required|file|mimes:pdf,xml|max:80960',
                    'files.factura_pago'   => 'required|file|mimes:pdf,xml|max:40960',
                ];
                break;
            case 277:
                $rules = [
                    'id_documento_soporte' => 'required|not_zero',
                    'files.contrato'       => 'required|file|mimes:pdf|max:40960',
                    'files.fianzas'        => 'required|file|mimes:pdf,xml|max:40960',
                    'files.reporte_avance' => 'required|file|mimes:pdf,xml|max:40960',
                    'files.estimacion'     => 'required|file|mimes:pdf,xml|max:80960',
                    'files.factura_pago'   => 'required|file|mimes:pdf,xml|max:40960',
                ];
                break;
            // case 305:
            //     $rules = [
            //         'id_documento_soporte'     => 'required|not_zero',
            //         'files.relacion_analitica' => 'required|file|mimes:pdf|max:40960',
            //         'files.estado_cuenta'      => 'required|file|mimes:pdf|max:40960',
            //     ];
            //     break;
            // case 306:
            //     $rules = [
            //         'id_documento_soporte'     => 'required|not_zero',
            //         'files.relacion_analitica' => 'required|file|mimes:pdf|max:100960',
            //         // 'files.estado_cuenta'    => 'required|file|mimes:pdf|max:40960',
            //         'files.facturas_xml'       => 'required|file|mimes:pdf,xml|max:100960',
            //         // 'files.contrato'         => 'required|file|mimes:pdf|max:40960'
            //     ];
            //     break;
            // case 307:
            //     $rules = [
            //         'id_documento_soporte'     => 'required|not_zero',
            //         'files.pagare'             => 'required|file|mimes:pdf|max:100960',
            //         'files.estado_cuenta'      => 'required|file|mimes:pdf|max:100960',
            //         'files.contrato'           => 'required|file|mimes:pdf|max:100960',
            //         'files.relacion_analitica' => 'required|file|mimes:pdf|max:100960',
            //     ];
            //     break;
            // case 308:
            //     $rules = [
            //         'id_documento_soporte'     => 'required|not_zero',
            //         'files.relacion_analitica' => 'required|file|mimes:pdf|max:40960',
            //         'files.facturas'           => 'required|file|mimes:pdf|max:40960',
            //         'files.estado_cuenta'      => 'required|file|mimes:pdf|max:40960',
            //         // opcional
            //         // 'files.contrato'      => 'required|file|mimes:pdf|max:40960'
            //     ];
            //     break;
            // case 309:
            //     $rules = [
            //         'id_documento_soporte'     => 'required|not_zero',
            //         'files.relacion_analitica' => 'required|file|mimes:pdf|max:40960',
            //         'files.facturas_xml'       => 'required|file|mimes:pdf,xml|max:40960',
            //     ];
            //     break;
            // case 310:
            //     $rules = [
            //         'id_documento_soporte'     => 'required|not_zero',
            //         'files.relacion_analitica' => 'required|file|mimes:pdf|max:40960',
            //         'files.facturas_xml'       => 'required|file|mimes:pdf,xml|max:40960',
            //     ];
            //     break;
            // case 311:
            //     $rules = [
            //         'id_documento_soporte'     => 'required|not_zero',
            //         'files.relacion_analitica' => 'required|file|mimes:pdf|max:100960',
            //         'files.escritura_publica'  => 'required|file|mimes:pdf|max:100960',
            //         'files.pago_predial'       => 'required|file|mimes:pdf|max:100960',
            //         // opcional
            //         // 'files.avaluo'      => 'required|file|mimes:pdf|max:40960',
            //     ];
            //     break;
            // case 312:
            //     $rules = [
            //         'id_documento_soporte'      => 'required|not_zero',
            //         'files.relacion_analitica'  => 'required|file|mimes:pdf|max:100960',
            //         'files.facturas_xml'        => 'required|file|mimes:pdf,xml|max:100960',
            //         'files.reporte_fotografico' => 'required|file|mimes:pdf|max:100960',
            //     ];
            //     break;
            // case 313:
            //     $rules = [
            //         'id_documento_soporte'     => 'required|not_zero',
            //         'files.relacion_analitica' => 'required|file|mimes:pdf|max:40960',
            //         'files.facturas_xml'       => 'required|file|mimes:pdf,xml|max:40960',
            //     ];
            //     break;
            // case 314:
            //     $rules = [
            //         'id_documento_soporte'      => 'required|not_zero',
            //         'files.relacion_analitica'  => 'required|file|mimes:pdf|max:40960',
            //         'files.facturas'            => 'required|file|mimes:pdf|max:40960',
            //         'files.pago_refrendo'       => 'required|file|mimes:pdf|max:40960',
            //         'files.tarjeta_circulacion' => 'required|file|mimes:pdf|max:40960',
            //     ];
            //     break;
            // case 315:
            //     $rules = [
            //         'id_documento_soporte'     => 'required|not_zero',
            //         'files.relacion_analitica' => 'required|file|mimes:pdf|max:40960',
            //         'files.facturas_xml'       => 'required|file|mimes:pdf,xml|max:40960',
            //     ];
            //     break;
            // case 316:
            //     $rules = [
            //         'id_documento_soporte'     => 'required|not_zero',
            //         'files.relacion_analitica' => 'required|file|mimes:pdf|max:40960',
            //         'files.facturas_xml'       => 'required|file|mimes:pdf,xml|max:40960',
            //     ];
            //     break;
            // case 317:
            //     $rules = [
            //         'files-alias'                 => 'required',
            //         'id_documento_soporte'        => 'required|not_zero',
            //         'files.relacion_analitica'    => 'required|file|mimes:pdf|max:40960',
            //         'files.documentacion_soporte' => 'required|file|mimes:pdf|max:40960',
            //     ];
            //     break;
            case 354:
                $rules = [
                    'id_documento_soporte'  => 'required|not_zero',
                    'files.cedula'          => 'required|file|mimes:pdf|max:40960',
                    'files.curp'            => 'required|file|mimes:pdf,xml|max:40960',
                    'files.ife_ine'         => 'required|file|mimes:pdf,xml|max:40960',
                    'files.curriculum_rtec' => 'required|file|mimes:pdf,xml|max:40960',

                ];
                break;

            case 356:
                $rules = [
                    'id_documento_soporte' => 'required|not_zero',
                    'files.cedula'         => 'required|file|mimes:pdf|max:40960',
                    // 'files.rfc'      => 'required|file|mimes:pdf,xml|max:40960',
                    'files.ife_ine'        => 'required|file|mimes:pdf,xml|max:40960',
                    // 'files.curp'      => 'required|file|mimes:pdf,xml|max:40960',
                    // 'files.comprobante_fiscal'      => 'required|file|mimes:pdf,xml|max:40960'
                    // 'files.constancia_colegio'      => 'required|file|mimes:pdf,xml|max:40960'

                ];
                break;

        }
        return $rules;
    }
}
