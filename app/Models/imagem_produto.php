<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;


/**
 * Class imagem_produto
 * @package App\Models
 * @version December 15, 2021, 9:13 am -03
 *
 * @property \App\Models\produto $produto
 * @property string $nome
 * @property string $link
 * @property integer $produto_id
 * @property array $info
 */
class imagem_produto extends Model
{
    use SoftDeletes;

    public $table = 'imagem_produtos';

    protected $dates = ['deleted_at'];

    protected $appends = array('cor_data', 'cor_text');

    protected $info;

    public $fillable = [
        'nome',
        'link',
        'produto_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nome' => 'string',
        'produto_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


    public function produto()
    {
        return $this->hasOne(\App\Models\produto::class, 'id', 'produto_id');
    }


    public function cor()
    {
        return $this->belongsToMany(cor::class,'imagem_cors','imagem_id','cor_id');
    }

    public function getCorDataAttribute()
    {
        return $this->cor->pluck('id', 'cor');
    }

    public function getCorTextAttribute()
    {
        return $this->cor->pluck('cor')->implode(' ');
    }

    public function produto_cor($cor_id,$categoria_id,$busca)
    {

        $produtos = DB::table('imagem_produtos')
            ->join('produtos', 'imagem_produtos.produto_id', '=', 'produtos.id')
            ->join('imagem_cors', 'imagem_produtos.id', '=', 'imagem_cors.imagem_id')
            ->join('cors', 'imagem_cors.cor_id', '=', 'cors.id')
            ->addSelect('produtos.nome',
                'produtos.referencia',
                'imagem_produtos.nome',
                'imagem_produtos.link',
                'imagem_produtos.produto_id',
                'imagem_cors.imagem_id',
                'imagem_cors.imagem_id as info')
            ->addSelect(DB::raw('group_concat(imagem_cors.cor_id) as cor_id'))
            ->addSelect(DB::raw('group_concat(cors.cor) as cor'))
            ->addSelect(DB::raw('group_concat(cors.referencia) as referencia'))
            ->groupBy('imagem_cors.imagem_id',
                        'produtos.nome',
                        'produtos.referencia',
                        'imagem_produtos.nome',
                        'imagem_produtos.link',
                        'imagem_produtos.produto_id',
                        'imagem_cors.imagem_id');


        if (!empty($cor_id))
            $produtos->WhereIn('cors.id', $cor_id);
        if (!empty($categoria_id))
            $produtos->Where('produtos.categoria_id','=', $categoria_id);
        if (!empty($busca))
            $produtos->Where('imagem_produtos.nome','like', '%'.$busca.'%');

        return $produtos->get();


//        ->select('produtos.nome',
//        'produtos.referencia',
//        'imagem_produtos.nome',
//        'imagem_produtos.link',
//        'imagem_produtos.produto_id',
//        'imagem_cors.imagem_id',
//        'imagem_cors.cor_id',
//        'cors.cor',
//        'cors.referencia');
    }

    public function produto_has()
    {
        return $this->belongsToMany(produto::class,'montagem_has_produto','produto_id','montagem_id','quatidade');
    }

    public function imagem_has_cor_delete($id){
        return DB::delete('delete from imagem_cors where imagem_id = '.$id);
    }
}
