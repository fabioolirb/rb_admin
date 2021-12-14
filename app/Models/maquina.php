<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class maquina
 * @package App\Models
 * @version December 10, 2021, 2:01 pm -03
 *
 * @property string $nome
 */
class maquina extends Model
{
    use SoftDeletes;


    public $table = 'maquinas';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'nome'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nome' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
