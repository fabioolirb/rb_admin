<?php

namespace App\Repositories;

use App\Models\categoria;
use App\Repositories\BaseRepository;

/**
 * Class categoriaRepository
 * @package App\Repositories
 * @version December 10, 2021, 2:06 pm -03
*/

class categoriaRepository extends BaseRepository
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
        return categoria::class;
    }
}
