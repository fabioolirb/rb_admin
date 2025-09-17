<?php

namespace App\Repositories;

use App\Models\prototipos;
use App\Repositories\BaseRepository;

/**
 * Class prototiposRepository
 * @package App\Repositories
 * @version April 18, 2023, 11:40 am -03
*/

class prototiposRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'desc_prototipo',
        'id_imagem_produto',
        'id_cliente',
        'id_ilustrador'
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
        return prototipos::class;
    }
}
