<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class montagem
 * @package App\Models
 * @version March 16, 2022, 11:53 am -03
 *
 * @property \Illuminate\Database\Eloquent\Collection $statusMontagems
 * @property \Illuminate\Database\Eloquent\Collection $montadoras
 * @property string $data_envio
 * @property string $data_retorno
 * @property integer $status_montagem_id
 * @property integer $montadora_id
 */
class montagem extends Model
{
    use SoftDeletes;

    public $table = 'montagem';

    protected $dates = ['deleted_at'];

    protected $appends = array('itens_Qtd', 'itens_Total');

    public $fillable = [
        'data_envio',
        'data_retorno',
        'status_montagem_id',
        'montadora_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'data_envio' => 'date:d/m/Y',
        'data_retorno' => 'date:d/m/Y',
        'status_montagem_id' => 'integer',
        'montadora_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function statusMontagems()
    {
        return $this->belongsTo(\App\Models\status_montagem::class, 'status_montagem_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function montadoras()
    {
        return $this->belongsTo(\App\Models\montadora::class, 'montadora_id', 'id');
    }

    public function produto()
    {
        return $this->belongsToMany(produto::class,'montagem_has_produto')->withPivot(['quantidade']);
    }

    public function itensMontagem()
    {
        return $this->belongsToMany(montagem::class,'montagem_has_produto')
            ->selectRaw('SUM(montagem_has_produto.quantidade) as quantidade ')
            ->groupBy('montagem_has_produto.montagem_id');
    }

    public function getItensQtdAttribute()
    {
        //dd($this->itensMontagem);
        return $this->produto->count('montagem_has_produto.montagem_id');
    }

    public function getItensTotalAttribute()
    {
        return $this->itensMontagem->sum('quantidade');
    }

}
