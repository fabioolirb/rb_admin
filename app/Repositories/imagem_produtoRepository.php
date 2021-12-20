<?php

namespace App\Repositories;

use App\Models\cor;
use App\Models\imagem_produto;
use App\Repositories\BaseRepository;

/**
 * Class imagem_produtoRepository
 * @package App\Repositories
 * @version December 15, 2021, 9:13 am -03
*/

class imagem_produtoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome',
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
        return imagem_produto::class;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function produto()
    {
        return $this->hasOne(\App\Models\produto::class, 'id', 'produto_id');
    }

    public function cor()
    {
        return $this->belongsToMany(cor::class,'imagem_cors','imagem_id','cor_id');
    }
}
