<?php

namespace App\Repositories;

use App\Models\status_montadora;
use App\Repositories\BaseRepository;

/**
 * Class status_montadoraRepository
 * @package App\Repositories
 * @version March 15, 2022, 3:15 pm -03
*/

class status_montadoraRepository extends BaseRepository
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
        return status_montadora::class;
    }
}
