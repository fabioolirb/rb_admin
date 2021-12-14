<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class produto
 * @package App\Models
 * @version December 10, 2021, 2:21 pm -03
 *
 * @property \App\Models\categoria $categoria
 * @property integer $nome
 * @property integer $referencia
 * @property integer $prazo_producao
 * @property integer $categoria_id
 */
class produto extends Model
{
    use SoftDeletes;


    public $table = 'produtos';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nome',
        'referencia',
        'prazo_producao',
        'categoria_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nome' => 'string',
        'referencia' => 'string',
        'prazo_producao' => 'integer',
        'categoria_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function categorias()
    {
        return $this->hasOne(\App\Models\categoria::class, 'id', 'categoria_id');
    }
}
