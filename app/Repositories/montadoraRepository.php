<?php

namespace App\Repositories;

use App\Models\montadora;
use App\Repositories\BaseRepository;

/**
 * Class montadoraRepository
 * @package App\Repositories
 * @version March 15, 2022, 3:34 pm -03
*/

class montadoraRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome',
        'fone',
        'ddd',
        'contrato',
        'logradouro',
        'bairro',
        'nr',
        'cidade_id',
        'estado_id'
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
        return montadora::class;
    }
}
