<?php

namespace App\Repositories;

use App\Models\maquina;
use App\Repositories\BaseRepository;

/**
 * Class maquinaRepository
 * @package App\Repositories
 * @version December 10, 2021, 2:01 pm -03
*/

class maquinaRepository extends BaseRepository
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
        return maquina::class;
    }
}
