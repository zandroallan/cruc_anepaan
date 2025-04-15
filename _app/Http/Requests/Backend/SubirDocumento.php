<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class SubirDocumento extends FormRequest
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
        //$array= $this->input('archivosubido');
        //print_r("aa".$array); exit(); 
        //40 MB validados           
        $rules=[
            'id_documento' =>'required|not_zero',             
            'archivosubido' =>'required|file|mimes:pdf,zip|max:80960'        

        ];
        return $rules;
    }
}
