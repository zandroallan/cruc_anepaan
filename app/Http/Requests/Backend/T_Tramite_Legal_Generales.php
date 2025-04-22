<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class T_Tramite_Legal_Generales extends FormRequest
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
        $rules=[
            'dlg_imss' =>'required', 
            'dlg_boleta_pago' =>'required',
            'dlg_fecha_pago' =>'required|date_format:Y-m-d',
            'dlg_fecha_inicio' =>'required|date_format:Y-m-d',
            'dlg_fecha_inscripcion' =>'required|date_format:Y-m-d',
            'dlg_actividad' =>'required',
            //'dlg_rec' =>'required|date_format:d/m/Y',
            'dlg_num_constancia' =>'required',
            'dlg_num_control' =>'required',
            'dlg_vigencia_de' =>'required|date_format:Y-m-d',
            'dlg_vigencia_al' =>'required|date_format:Y-m-d'
        ];
        return $rules;
    }
}
