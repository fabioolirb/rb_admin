<?php

namespace App\Repositories;

use App\Models\Cidade;
use App\Repositories\BaseRepository;

/**
 * Class CidadeRepository
 * @package App\Repositories
 * @version December 8, 2021, 1:37 pm -03
*/

class CidadeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome',
        'ibge',
        'estado_id',
        'uf'
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
        return Cidade::class;
    }

}
