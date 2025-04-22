<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class T_Tramite_Legal_Acta_Constitutiva extends FormRequest
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
            'dlac_num_escritura' =>'required',
            'dlac_fecha_escritura' =>'required|date_format:Y-m-d',
            'dlac_notario_nombre' =>'required',
            'dlac_notario_numero' =>'required',
            'dlac_id_estado' =>'required|not_zero',
            'dlac_num_registro_publico' =>'required',
            'dlac_seccion' =>'required',
            'dlac_ciudad' =>'required',
            'dlac_fecha_registro_publico' =>'required|date_format:Y-m-d',
            'dlac_id_estado_registro' =>'required|not_zero'
        ];
        return $rules;
    }
}
