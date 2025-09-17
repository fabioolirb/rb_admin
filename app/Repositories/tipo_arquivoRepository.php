<?php

namespace App\Repositories;

use App\Models\tipo_arquivo;
use App\Repositories\BaseRepository;

/**
 * Class tipo_arquivoRepository
 * @package App\Repositories
 * @version April 17, 2023, 2:17 pm -03
*/

class tipo_arquivoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'desc_tipo_arquivo'
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
        return tipo_arquivo::class;
    }
}
