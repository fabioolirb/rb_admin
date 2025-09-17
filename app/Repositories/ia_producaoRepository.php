<?php

namespace App\Repositories;

use App\Models\ia_producao;
use App\Repositories\BaseRepository;

/**
 * Class ia_producaoRepository
 * @package App\Repositories
 * @version August 7, 2024, 3:57 pm -03
*/

class ia_producaoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
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
        return ia_producao::class;
    }
}
