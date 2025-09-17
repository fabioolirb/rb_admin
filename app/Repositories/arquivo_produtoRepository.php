<?php

namespace App\Repositories;

use App\Models\arquivo_produto;
use App\Repositories\BaseRepository;

/**
 * Class arquivo_produtoRepository
 * @package App\Repositories
 * @version May 13, 2025, 8:19 pm -03
*/

class arquivo_produtoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome',
        'tipo_arquivo_id',
        'link',
        'produto_id'
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
        return arquivo_produto::class;
    }
}
