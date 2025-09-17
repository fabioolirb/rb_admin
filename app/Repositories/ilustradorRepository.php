<?php

namespace App\Repositories;

use App\Models\ilustrador;
use App\Repositories\BaseRepository;

/**
 * Class ilustradorRepository
 * @package App\Repositories
 * @version April 17, 2023, 12:27 pm -03
*/

class ilustradorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome_ilustrador'
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
        return ilustrador::class;
    }
}
