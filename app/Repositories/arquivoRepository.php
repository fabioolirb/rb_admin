<?php

namespace App\Repositories;

use App\Models\arquivo;
use App\Repositories\BaseRepository;

/**
 * Class arquivoRepository
 * @package App\Repositories
 * @version April 17, 2023, 2:22 pm -03
*/

class arquivoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'desc_arquivo',
        'link_arquivo',
        'id_tipo_arquivo'
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
        return arquivo::class;
    }
}
