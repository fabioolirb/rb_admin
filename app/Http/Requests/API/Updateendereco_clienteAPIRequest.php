<?php

namespace App\Http\Requests\API;

use App\Models\endereco_cliente;
use InfyOm\Generator\Request\APIRequest;

class Updateendereco_clienteAPIRequest extends APIRequest
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
        $rules = endereco_cliente::$rules;
        
        return $rules;
    }
}
