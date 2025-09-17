<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class endereco_cliente
 * @package App\Models
 * @version April 17, 2023, 2:25 pm -03
 *
 * @property \Illuminate\Database\Eloquent\Collection $cidades
 * @property string $desc_endereco_cliente
 * @property string $rua_endereco_cliente
 * @property string $nr_endereco_cliente
 * @property string $bairro_endereco_cliente
 * @property integer $id_cidade
 * @property string $cep_endereco_cliente
 * @property string $complemento_endereco_cliente
 */
class endereco_cliente extends Model
{
    use SoftDeletes;
   public $table = 'endereco_cliente';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'desc_endereco_cliente',
        'rua_endereco_cliente',
        'nr_endereco_cliente',
        'bairro_endereco_cliente',
        'id_cidade',
        'cep_endereco_cliente',
        'complemento_endereco_cliente'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'desc_endereco_cliente' => 'string',
        'rua_endereco_cliente' => 'string',
        'nr_endereco_cliente' => 'string',
        'bairro_endereco_cliente' => 'string',
        'id_cidade' => 'integer',
        'cep_endereco_cliente' => 'string',
        'complemento_endereco_cliente' => 'string'
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
    public function cidades()
    {
        return $this->hasMany(\App\Models\cidade::class, 'id', 'id_cidade');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function estados()
    {
        return $this->belongsTo(\App\Models\Estados::class, 'estado_id', 'id');
    }
}
