<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ContactoRequest extends FormRequest
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
            'nombre_contacto' =>'required',        
            'ap_paterno_contacto' =>'required',
            'ap_materno_contacto' =>'required',
            'cargo_contacto' =>'required',    
        ];
        return $rules;
    }
}
