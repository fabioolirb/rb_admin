<?php

namespace App\Repositories;

use App\Models\estoque;
use App\Repositories\BaseRepository;

/**
 * Class estoqueRepository
 * @package App\Repositories
 * @version March 14, 2022, 12:23 pm -03
*/

class estoqueRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'qtd_estoque',
        'ordem_id',
        'data_producao'
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
        return estoque::class;
    }
}
