<?php

namespace App\Repositories;

use App\Models\Estados;
use App\Repositories\BaseRepository;

/**
 * Class EstadosRepository
 * @package App\Repositories
 * @version December 8, 2021, 12:25 pm -03
*/

class EstadosRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome',
        'uf'
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
        return Estados::class;
    }
}
