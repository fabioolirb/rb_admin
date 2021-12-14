<?php

namespace App\Repositories;

use App\Models\operador;
use App\Repositories\BaseRepository;

/**
 * Class operadorRepository
 * @package App\Repositories
 * @version December 10, 2021, 1:58 pm -03
*/

class operadorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome'
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
        return operador::class;
    }
}
