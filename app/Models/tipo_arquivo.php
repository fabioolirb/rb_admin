<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class tipo_arquivo
 * @package App\Models
 * @version April 17, 2023, 2:17 pm -03
 *
 * @property string $desc_tipo_arquivo
 */
class tipo_arquivo extends Model
{
    use SoftDeletes;


    public $table = 'tipo_arquivo';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'desc_tipo_arquivo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'desc_tipo_arquivo' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
