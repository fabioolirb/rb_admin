<?php

namespace App\Repositories;

use App\Models\endereco_cliente;
use App\Repositories\BaseRepository;

/**
 * Class endereco_clienteRepository
 * @package App\Repositories
 * @version April 17, 2023, 2:25 pm -03
*/

class endereco_clienteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'desc_endereco_cliente',
        'rua_endereco_cliente',
        'nr_endereco_cliente',
        'bairro_endereco_cliente',
        'id_cidade',
        'cep_endereco_cliente',
        'complemento_endereco_cliente'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return endereco_cliente::class;
    }
}
