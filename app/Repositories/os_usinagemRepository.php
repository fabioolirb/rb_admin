<?php

namespace App\Repositories;

use App\Models\os_usinagem;
use App\Repositories\BaseRepository;

/**
 * Class os_usinagemRepository
 * @package App\Repositories
 * @version February 21, 2024, 4:58 pm -03
*/

class os_usinagemRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_cnc',
        'id_prototipo',
        'data_ini',
        'data_fim'
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
        return os_usinagem::class;
    }
}
