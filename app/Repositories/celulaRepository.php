<?php

namespace App\Repositories;

use App\Models\celula;
use App\Repositories\BaseRepository;

/**
 * Class celulaRepository
 * @package App\Repositories
 * @version August 24, 2022, 5:12 pm -03
*/

class celulaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome',
        'tuno_id'
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
        return celula::class;
    }
}
