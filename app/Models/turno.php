<?php

namespace App\Models;

use Eloquent as Model;



/**
 * Class turno
 * @package App\Models
 * @version December 10, 2021, 3:17 pm -03
 *
 * @property string $nome
 */
class turno extends Model
{


    public $table = 'turnos';
    



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
