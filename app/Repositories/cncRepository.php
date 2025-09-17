<?php

namespace App\Repositories;

use App\Models\cnc;
use App\Repositories\BaseRepository;

/**
 * Class cncRepository
 * @package App\Repositories
 * @version February 21, 2024, 4:27 pm -03
*/

class cncRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'desc_cnc'
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
        return cnc::class;
    }
}
