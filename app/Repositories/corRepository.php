<?php

namespace App\Repositories;

use App\Models\cor;
use App\Repositories\BaseRepository;

/**
 * Class corRepository
 * @package App\Repositories
 * @version December 9, 2021, 10:11 am -03
*/

class corRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cor',
        'referencia'
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
        return cor::class;
    }
}
