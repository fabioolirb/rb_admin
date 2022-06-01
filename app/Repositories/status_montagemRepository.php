<?php

namespace App\Repositories;

use App\Models\status_montagem;
use App\Repositories\BaseRepository;

/**
 * Class status_montagemRepository
 * @package App\Repositories
 * @version March 15, 2022, 3:16 pm -03
*/

class status_montagemRepository extends BaseRepository
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
        return status_montagem::class;
    }
}
