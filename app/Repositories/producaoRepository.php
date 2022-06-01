<?php

namespace App\Repositories;

use App\Models\producao;
use App\Repositories\BaseRepository;

/**
 * Class producaoRepository
 * @package App\Repositories
 * @version January 3, 2022, 4:46 pm -03
*/

class producaoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'data',
        'data_ini',
        'data_fim',
        'imagem_id',
        'maquina_id',
        'turno_id',
        'operador_id'
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
        return producao::class;
    }
}
