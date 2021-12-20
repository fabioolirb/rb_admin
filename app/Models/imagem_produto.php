<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class imagem_produto
 * @package App\Models
 * @version December 15, 2021, 9:13 am -03
 *
 * @property \App\Models\produto $produto
 * @property string $nome
 * @property string $link
 * @property integer $produto_id
 */
class imagem_produto extends Model
{
    use SoftDeletes;


    public $table = 'imagem_produtos';


    protected $dates = ['deleted_at'];

    protected $appends = array('cor_data', 'cor_text');

    public $fillable = [
        'nome',
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
        'produto_id' => 'integer'
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
        return $this->cor->pluck('cor')->implode(',');
    }

}
