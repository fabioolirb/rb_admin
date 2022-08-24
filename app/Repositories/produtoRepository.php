<?php

namespace App\Repositories;

use App\Models\categoria;
use App\Models\Estados;
use App\Models\produto;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

/**
 * Class produtoRepository
 * @package App\Repositories
 * @version December 10, 2021, 2:21 pm -03
*/

class produtoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome',
        'referencia',
        'prazo_producao',
        'categoria_id'
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
        return produto::class;
    }
    public function categorias(){
        return $this->hasMany(categorias::class);
    }
}
