<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class arquivo_produto
 * @package App\Models
 * @version May 13, 2025, 8:19 pm -03
 *
 * @property \Illuminate\Database\Eloquent\Collection $tipoArquivos
 * @property string $arquivo_produto
 * @property integer $tipo_arquivo_id
 * @property string $Link
 */
class arquivo_produto extends Model
{
    use SoftDeletes;


    public $table = 'arquivo_produto';

    protected $dates = ['deleted_at'];



    public $fillable = [
        'nome',
        'tipo_arquivo_id',
        'link',
        'produto_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nome' => 'string',
        'tipo_arquivo_id' => 'integer',
        'link' => 'string',
        'produto_id' => 'integer'
    ];


    public static $rules = [
        'nome' => 'required|string|max:255',
        'tipo_arquivo_id' => 'required|integer',
        'produto_id' => 'required|integer'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function tipoArquivos()
    {
        return $this->hasOne(\App\Models\tipo_arquivo::class, 'id', 'tipo_arquivo_id');
    }

    public  function getProduto()
    {
        return $this->hasOne(\App\Models\produto::class, 'id', 'produto_id');
    }

}
