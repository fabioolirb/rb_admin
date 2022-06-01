<?php

namespace App\Repositories;

use App\Models\status_ordem;
use App\Repositories\BaseRepository;

/**
 * Class status_ordemRepository
 * @package App\Repositories
 * @version March 15, 2022, 3:13 pm -03
*/

class status_ordemRepository extends BaseRepository
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
        return status_ordem::class;
    }
}
