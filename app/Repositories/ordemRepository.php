<?php

namespace App\Repositories;

use App\Models\ordem;
use App\Repositories\BaseRepository;

/**
 * Class ordemRepository
 * @package App\Repositories
 * @version January 3, 2022, 3:47 pm -03
*/

class ordemRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'data_ini',
        'data_end'
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
        return ordem::class;
    }
}
