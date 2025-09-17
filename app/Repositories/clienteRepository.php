<?php

namespace App\Repositories;

use App\Models\cliente;
use App\Repositories\BaseRepository;

/**
 * Class clienteRepository
 * @package App\Repositories
 * @version April 17, 2023, 2:29 pm -03
*/

class clienteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome_cliente',
        'responsavel_cliente',
        'documento_cliente',
        'contato_cliente',
        'contato2_cliente',
        'id_endereco_cliente'
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
        return cliente::class;
    }
}
