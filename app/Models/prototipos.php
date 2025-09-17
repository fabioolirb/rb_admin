<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class prototipos
 * @package App\Models
 * @version April 18, 2023, 11:40 am -03
 *
 * @property string $desc_prototipo
 * @property integer $id_imagem_produto
 * @property integer $id_cliente
 * @property integer $id_ilustrador
 */
class prototipos extends Model
{
    use SoftDeletes;


    public $table = 'prototipos';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'desc_prototipo',
        'id_imagem_produto',
        'id_cliente',
        'id_ilustrador'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'id_imagem_produto' => 'integer',
        'id_cliente' => 'integer',
        'id_ilustrador' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


    public function imagems()
    {
        return  $this->hasMany(\App\Models\imagem_produto::class,'imagem_id','id');
    }

    public function clientes()
    {
        return  $this->hasMany(\App\Models\cliente::class,'id','id_cliente');
    }


}
