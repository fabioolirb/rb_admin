<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Cidade
 * @package App\Models
 * @version December 8, 2021, 1:37 pm -03
 *
 * @property string $nome
 * @property integer $ibge
 * @property integer $estado_id
 */
class Cidade extends Model
{
    use SoftDeletes;


    public $table = 'cidades';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'id',
        'nome',
        'ibge',
        'estado_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nome' => 'string',
        'ibge' => 'integer',
        'estado_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function Estado( )
    {
        return $this->belongsTo(Estados::class, 'estado_id','id');
    }


}
