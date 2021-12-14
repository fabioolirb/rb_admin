<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Estados
 * @package App\Models
 * @version December 8, 2021, 12:25 pm -03
 *
 * @property string $nome
 * @property string $uf
 */
class Estados extends Model
{
    use SoftDeletes;


    public $table = 'estados';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nome',
        'uf'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nome' => 'string',
        'uf' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function cidades()
    {
        return $this->hasMany(\App\Models\Cidades::class,'estado_id','id');
    }

}
