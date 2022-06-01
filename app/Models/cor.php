<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class cor
 * @package App\Models
 * @version December 9, 2021, 10:11 am -03
 *
 * @property string $cor
 */
class cor extends Model
{
    use SoftDeletes;


    public $table = 'cors';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'cor',
        'referencia'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'ordem_id' => 'integer',
        'maquina_id' => 'integer',
        'data_ini' => 'date',
        'data_end' => 'date',
        'producao_id' => 'integer',
        'data' => 'date',
        'imagem_id' => 'integer',
        'turno_id' =>  'integer',
        'operador_id'=> 'integer',
        'qtd_diario' => 'integer',
        'turnos_nome' => 'integer',
        'nome' => 'string',
        'imagem_produtos_nome' => 'integer',
        'link' => 'string',
        'produto_id' => 'integer',
        'cor_id' => 'integer',
        'cor' => 'string',
        'referencia' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function imagem_produto()
    {
        return $this->belongsToMany(\App\Models\imagem_produto::class,'imagem_cors','cor_id','imagem_id');

    }

    public function ordem_cors()
    {
        return $this->belongsToMany(\App\Models\cor::class,'order_cors','cor_id','id');

    }


}
