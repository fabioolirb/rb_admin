<?php

namespace App\Repositories;

use App\Models\turno;
use App\Repositories\BaseRepository;

/**
 * Class turnoRepository
 * @package App\Repositories
 * @version December 10, 2021, 3:17 pm -03
*/

class turnoRepository extends BaseRepository
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
        return turno::class;
    }
}
