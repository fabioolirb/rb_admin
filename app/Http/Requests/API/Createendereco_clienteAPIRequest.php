<?php

namespace App\Http\Requests\API;

use App\Models\endereco_cliente;
use InfyOm\Generator\Request\APIRequest;

class Createendereco_clienteAPIRequest extends APIRequest
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
        return endereco_cliente::$rules;
    }
}
