<?php

namespace App\Repositories;

use App\Models\matriz;
use App\Repositories\BaseRepository;

/**
 * Class matrizRepository
 * @package App\Repositories
 * @version August 24, 2022, 3:42 pm -03
*/

class matrizRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'linha',
        'coluna',
        'produto_id',
        'quantidade'
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
        return matriz::class;
    }
}
