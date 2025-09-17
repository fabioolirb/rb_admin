<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class cliente
 * @package App\Models
 * @version April 17, 2023, 2:29 pm -03
 *
 * @property \Illuminate\Database\Eloquent\Collection $enderecoClientes
 * @property string $nome_cliente
 * @property string $responsavel_cliente
 * @property string $documento_cliente
 * @property string $contato_cliente
 * @property string $contato2_cliente
 * @property string $id_endereco_cliente
 */
class cliente extends Model
{
    use SoftDeletes;


    public $table = 'cliente';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nome_cliente',
        'responsavel_cliente',
        'documento_cliente',
        'contato_cliente',
        'contato2_cliente',
        'id_endereco_cliente'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nome_cliente' => 'string',
        'responsavel_cliente' => 'string',
        'documento_cliente' => 'string',
        'contato_cliente' => 'string',
        'contato2_cliente' => 'string',
        'id_endereco_cliente' => 'string'
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
    public function enderecoClientes()
    {
        return $this->hasMany(\App\Models\endereco_cliente::class, 'id', 'id_endereco_cliente');
    }
}
