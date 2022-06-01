<?php

namespace App\Repositories;

use App\Models\montagem;
use App\Repositories\BaseRepository;

/**
 * Class montagemRepository
 * @package App\Repositories
 * @version March 16, 2022, 11:53 am -03
*/

class montagemRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'data_envio',
        'data_retorno',
        'status_montagem_id',
        'montadora_id'
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
        return montagem::class;
    }
}
