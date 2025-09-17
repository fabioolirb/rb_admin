<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class ilustrador
 * @package App\Models
 * @version April 17, 2023, 12:27 pm -03
 *
 * @property string $nome_ilustrador
 */
class ilustrador extends Model
{
    use SoftDeletes;


    public $table = 'ilustrador';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'nome_ilustrador'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nome_ilustrador' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
