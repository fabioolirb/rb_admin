<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class arquivo
 * @package App\Models
 * @version April 17, 2023, 2:22 pm -03
 *
 * @property \Illuminate\Database\Eloquent\Collection $tipoArquivos
 * @property string $desc_arquivo
 * @property string $link_arquivo
 * @property integer $id_tipo_arquivo
 */
class arquivo extends Model
{
    use SoftDeletes;


    public $table = 'arquivo';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'desc_arquivo',
        'link_arquivo',
        'id_tipo_arquivo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'desc_arquivo' => 'string',
        'link_arquivo' => 'string',
        'id_tipo_arquivo' => 'integer'
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
    public function tipoArquivos()
    {
        return $this->hasMany(\App\Models\tipo_arquivo::class, 'id', 'id_tipo_arquivo');
    }
}
